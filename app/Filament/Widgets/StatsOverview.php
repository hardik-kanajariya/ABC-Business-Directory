<?php

namespace App\Filament\Widgets;

use App\Models\Blog;
use App\Models\Company;
use App\Models\Deal;
use App\Models\Event;
use App\Models\Job;
use App\Models\Product;
use App\Models\User;
use App\Models\WalletHistory;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class StatsOverview extends BaseWidget
{
    private string $userType;
    private int $userId;
    private int $userBalance;
    private int $userCompanyId;

    protected static ?int $sort = 1;
    
    // Add polling for real-time updates
    protected static ?string $pollingInterval = '30s';
    
    // Make the widget full width for better layout
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $prefix = '/user';
        $companyUrl = '';
        $user = auth()->user();
        $this->userType = $user->type;
        $this->userId = $user->id;
        $this->userBalance = $user->balance;
        $this->userCompanyId = $user->company ? $user->company->id : 0;

        $company = Company::where('user_id', $this->userId)->orderBy('created_at', 'desc')->first();
        if ($company) {
            $companyUrl = "user/companies/$company->id";
        }
        if ($this->userType == 'Admin') {
            $companyUrl = "admin/companies";
            $prefix = 'admin';
        }
        
        $walletTitle = $this->userType == 'Admin' ? 'Total Platform Balance' : 'Your Wallet Balance';

        // Enhanced chart data with better visualization
        $walletChart = $this->getWalletChart();
        $productsChart = $this->getProductsChart();
        $eventsChart = $this->getEventsChart();
        $jobsChart = $this->getJobsChart();

        $stats = [
            // Enhanced Wallet/Balance Card
            Stat::make($walletTitle, function () {
                if ($this->userType == 'Admin') {
                    return '$' . number_format(User::sum('balance'), 2);
                } else {
                    return '$' . number_format($this->userBalance, 2);
                }
            })
                ->description($this->getBalanceDescription())
                ->descriptionIcon($this->getBalanceIcon())
                ->chart($walletChart)
                ->color($this->getBalanceColor())
                ->icon('heroicon-o-banknotes')
                ->url($companyUrl)
                ->extraAttributes([
                    'class' => 'fi-stat-card-balance animate-pulse-subtle',
                ]),
        ];

        // Add Companies stat only for Admin
        if ($this->userType == 'Admin') {
            $stats[] = Stat::make('Total Companies', function () {
                return Company::count();
            })
                ->description($this->getCompaniesDescription())
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart($this->getCompaniesChart())
                ->color('info')
                ->icon('heroicon-o-building-office-2')
                ->url($companyUrl)
                ->extraAttributes([
                    'class' => 'fi-stat-card-companies',
                ]);
        }

        // Enhanced Products Card
        $stats[] = Stat::make('Products', function () {
            if ($this->userType == 'Admin') {
                return Product::count();
            } else {
                return Product::where('company_id', $this->userCompanyId)->count();
            }
        })
            ->description($this->getProductsDescription())
            ->descriptionIcon($this->getProductsDescriptionIcon())
            ->chart($productsChart)
            ->color($this->getProductsColor())
            ->icon('heroicon-o-shopping-bag')
            ->url("$prefix/products")
            ->extraAttributes([
                'class' => 'fi-stat-card-products hover:scale-105 transition-transform duration-200',
            ]);

        // Enhanced Events Card
        $stats[] = Stat::make('Events', function () {
            if ($this->userType == 'Admin') {
                return Event::count();
            } else {
                return Event::where('company_id', $this->userCompanyId)->count();
            }
        })
            ->description($this->getEventsDescription())
            ->descriptionIcon($this->getEventsDescriptionIcon())
            ->chart($eventsChart)
            ->color($this->getEventsColor())
            ->icon('heroicon-o-calendar-days')
            ->url("$prefix/events")
            ->extraAttributes([
                'class' => 'fi-stat-card-events hover:scale-105 transition-transform duration-200',
            ]);

        // Enhanced Jobs Card
        $stats[] = Stat::make('Job Openings', function () {
            if ($this->userType == 'Admin') {
                return Job::count();
            } else {
                return Job::where('company_id', $this->userCompanyId)->count();
            }
        })
            ->description($this->getJobsDescription())
            ->descriptionIcon($this->getJobsDescriptionIcon())
            ->chart($jobsChart)
            ->color($this->getJobsColor())
            ->icon('heroicon-o-briefcase')
            ->url("$prefix/jobs")
            ->extraAttributes([
                'class' => 'fi-stat-card-jobs hover:scale-105 transition-transform duration-200',
            ]);

        // Enhanced Blogs Card
        $stats[] = Stat::make('Blog Posts', function () {
            if ($this->userType == 'Admin') {
                return Blog::count();
            } else {
                return Blog::where('company_id', $this->userCompanyId)->count();
            }
        })
            ->description($this->getBlogsDescription())
            ->descriptionIcon($this->getBlogsDescriptionIcon())
            ->chart($this->getBlogsChart())
            ->color($this->getBlogsColor())
            ->icon('heroicon-o-document-text')
            ->url("$prefix/blogs")
            ->extraAttributes([
                'class' => 'fi-stat-card-blogs hover:scale-105 transition-transform duration-200',
            ]);

        // Enhanced Deals Card
        $stats[] = Stat::make('Active Deals', function () {
            if ($this->userType == 'Admin') {
                return Deal::count();
            } else {
                return Deal::where('company_id', $this->userCompanyId)->count();
            }
        })
            ->description($this->getDealsDescription())
            ->descriptionIcon($this->getDealsDescriptionIcon())
            ->chart($this->getDealsChart())
            ->color($this->getDealsColor())
            ->icon('heroicon-o-gift')
            ->url("$prefix/deals")
            ->extraAttributes([
                'class' => 'fi-stat-card-deals hover:scale-105 transition-transform duration-200',
            ]);

        return array_filter($stats); // Remove null values
    }

    // Helper methods for enhanced descriptions and charts

    private function getWalletChart(): array
    {
        if ($this->userType == 'user') {
            return WalletHistory::where('user_id', $this->userId)
                ->orderBy('created_at', 'desc')
                ->limit(7)
                ->get()
                ->pluck('amount')
                ->toArray();
        } else {
            return WalletHistory::selectRaw('DATE(created_at) as date, SUM(amount) as total')
                ->groupBy('date')
                ->orderBy('date', 'desc')
                ->limit(7)
                ->get()
                ->pluck('total')
                ->toArray();
        }
    }

    private function getBalanceDescription(): string
    {
        if ($this->userType == 'Admin') {
            $lastWeekBalance = WalletHistory::where('created_at', '>=', Carbon::now()->subWeek())->sum('amount');
            $change = $lastWeekBalance > 0 ? '+$' . number_format($lastWeekBalance, 2) : '$0.00';
            return "This week: {$change}";
        } else {
            $lastTransaction = WalletHistory::where('user_id', $this->userId)
                ->orderBy('created_at', 'desc')
                ->first();
            return $lastTransaction ? 
                'Last transaction: ' . Carbon::parse($lastTransaction->created_at)->diffForHumans() :
                'No recent transactions';
        }
    }

    private function getBalanceIcon(): string
    {
        if ($this->userType == 'Admin') {
            $lastWeekBalance = WalletHistory::where('created_at', '>=', Carbon::now()->subWeek())->sum('amount');
            return $lastWeekBalance > 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down';
        }
        return 'heroicon-m-clock';
    }

    private function getBalanceColor(): string
    {
        if ($this->userType == 'Admin') {
            $lastWeekBalance = WalletHistory::where('created_at', '>=', Carbon::now()->subWeek())->sum('amount');
            return $lastWeekBalance > 0 ? 'success' : 'danger';
        }
        return 'primary';
    }

    private function getProductsChart(): array
    {
        $query = Product::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date');

        if ($this->userType != 'Admin') {
            $query->where('company_id', $this->userCompanyId);
        }

        return $query->get()->pluck('count')->toArray();
    }

    private function getProductsDescription(): string
    {
        $thisWeekCount = Product::where('created_at', '>=', Carbon::now()->subWeek());
        if ($this->userType != 'Admin') {
            $thisWeekCount->where('company_id', $this->userCompanyId);
        }
        $count = $thisWeekCount->count();
        return "Added this week: {$count}";
    }

    private function getProductsDescriptionIcon(): string
    {
        return 'heroicon-m-plus';
    }

    private function getProductsColor(): string
    {
        return 'success';
    }

    private function getEventsChart(): array
    {
        $query = Event::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date');

        if ($this->userType != 'Admin') {
            $query->where('company_id', $this->userCompanyId);
        }

        return $query->get()->pluck('count')->toArray();
    }

    private function getEventsDescription(): string
    {
        $upcomingEvents = Event::where('start', '>=', Carbon::now());
        if ($this->userType != 'Admin') {
            $upcomingEvents->where('company_id', $this->userCompanyId);
        }
        $count = $upcomingEvents->count();
        return "Upcoming: {$count}";
    }

    private function getEventsDescriptionIcon(): string
    {
        return 'heroicon-m-calendar';
    }

    private function getEventsColor(): string
    {
        return 'warning';
    }

    private function getJobsChart(): array
    {
        $query = Job::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date');

        if ($this->userType != 'Admin') {
            $query->where('company_id', $this->userCompanyId);
        }

        return $query->get()->pluck('count')->toArray();
    }

    private function getJobsDescription(): string
    {
        $activeJobs = Job::where('is_active', '1'); // Assuming you have a status field
        if ($this->userType != 'Admin') {
            $activeJobs->where('company_id', $this->userCompanyId);
        }
        $count = $activeJobs->count();
        return "Active positions: {$count}";
    }

    private function getJobsDescriptionIcon(): string
    {
        return 'heroicon-m-user-group';
    }

    private function getJobsColor(): string
    {
        return 'info';
    }

    private function getBlogsChart(): array
    {
        $query = Blog::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date');

        if ($this->userType != 'Admin') {
            $query->where('company_id', $this->userCompanyId);
        }

        return $query->get()->pluck('count')->toArray();
    }

    private function getBlogsDescription(): string
    {
        $publishedThisWeek = Blog::where('created_at', '>=', Carbon::now()->subWeek());
        if ($this->userType != 'Admin') {
            $publishedThisWeek->where('company_id', $this->userCompanyId);
        }
        $count = $publishedThisWeek->count();
        return "Published this week: {$count}";
    }

    private function getBlogsDescriptionIcon(): string
    {
        return 'heroicon-m-pencil';
    }

    private function getBlogsColor(): string
    {
        return 'gray';
    }

    private function getDealsChart(): array
    {
        $query = Deal::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date');

        if ($this->userType != 'Admin') {
            $query->where('company_id', $this->userCompanyId);
        }

        return $query->get()->pluck('count')->toArray();
    }

    private function getDealsDescription(): string
    {
        $expiringThisWeek = Deal::where('is_Active', '1');
        if ($this->userType != 'Admin') {
            $expiringThisWeek->where('company_id', $this->userCompanyId);
        }
        $count = $expiringThisWeek->count();
        return "Expiring this week: {$count}";
    }

    private function getDealsDescriptionIcon(): string
    {
        return 'heroicon-m-clock';
    }

    private function getDealsColor(): string
    {
        return 'danger';
    }

    private function getCompaniesChart(): array
    {
        return Company::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('count')
            ->toArray();
    }

    private function getCompaniesDescription(): string
    {
        $newThisWeek = Company::where('created_at', '>=', Carbon::now()->subWeek())->count();
        return "New this week: {$newThisWeek}";
    }
}