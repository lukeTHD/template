<?php

namespace App\Providers;

use App\Commission;
use App\CommissionTemp;
use App\CreditActivity;
use App\FAQ;
use App\GameConfig;
use App\GameSettingCode;
use App\Repositories\Commission\CommissionInterface;
use App\Repositories\Commission\CommissionRepository;
use App\Repositories\CommissionTemp\CommissionTempInterface;
use App\Repositories\CommissionTemp\CommissionTempRepository;
use App\Repositories\CreditActivity\CreditActivityInterface;
use App\Repositories\CreditActivity\CreditActivityRepository;
use App\Repositories\FAQ\FAQInterface;
use App\Repositories\FAQ\FAQRepository;
use App\Repositories\GameSettingCode\GameSettingCodeRepository;
use App\Repositories\GameSettingCode\GameSettingCodeInterface;
use App\Repositories\Request\RequestInterface;
use App\Repositories\Request\RequestRepository;
use App\Repositories\Vault\VaultInterface;
use App\Repositories\Vault\VaultRepository;
use App\Request;
use App\Vault;
use App\VaultActivity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Booking;
use App\Contact;
use App\Credit;
use App\MetaBox;
use App\Game;
use App\GameReward;
use App\Lottery;
use App\LotteryRost;
use App\Page;
use App\Repositories\Booking\BookingInterface;
use App\Repositories\Booking\BookingRepository;
use App\Repositories\Contact\ContactInterface;
use App\Repositories\Contact\ContactRepository;
use App\Repositories\Credit\CreditInterface;
use App\Repositories\Credit\CreditRepository;
use App\Repositories\MetaBox\MetaBoxInterface;
use App\Repositories\MetaBox\MetaBoxRepository;
use App\Repositories\Game\GameInterface;
use App\Repositories\Game\GameRepository;
use App\Repositories\Lottery\LotteryInterface;
use App\Repositories\Lottery\LotteryRepository;
use App\Repositories\LotteryRost\LotteryRostInterface;
use App\Repositories\LotteryRost\LotteryRostRepository;
use App\Repositories\Page\PageInterface;
use App\Repositories\Page\PageRepository;
use App\Repositories\Ticket\TicketRepository;
use App\Repositories\Ticket\TicketInterface;
use App\Repositories\User\UserInterface;
use App\Repositories\User\UserRepository;
use App\Sack;
use App\Ticket;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(TicketInterface::class, function () {
            return new TicketRepository(new Ticket(), new Booking(), new User(), new Vault(), new Game());
        });

        $this->app->bind(GameInterface::class, function () {
            return new GameRepository(new Game(), new GameConfig(), new Sack(), new GameSettingCode(), new Vault());
        });

        $this->app->bind(UserInterface::class, function () {
            return new UserRepository(new User(), new Credit(), new GameConfig(), new Game(), new Ticket());
        });

        $this->app->bind(CreditInterface::class, function () {
            return new CreditRepository(new Credit());
        });

        $this->app->bind(BookingInterface::class, function () {
            return new BookingRepository(new Booking());
        });

        $this->app->bind(ContactInterface::class, function () {
            return new ContactRepository(new Contact());
        });

        $this->app->bind(PageInterface::class, function () {
            return new PageRepository(new Page());
        });

        $this->app->bind(MetaBoxInterface::class, function () {
            return new MetaBoxRepository(new MetaBox());
        });

        $this->app->bind(FAQInterface::class, function () {
            return new FAQRepository(new FAQ());
        });

        $this->app->bind(LotteryRostInterface::class, function () {
            return new LotteryRostRepository(new LotteryRost());
        });

        $this->app->bind(LotteryInterface::class, function () {
            return new LotteryRepository(new Lottery());
        });

        $this->app->bind(GameSettingCodeInterface::class, function () {
            return new GameSettingCodeRepository(new GameSettingCode());
        });

        $this->app->bind(VaultInterface::class, function () {
            return new VaultRepository(new Vault(), new VaultActivity());
        });

        $this->app->bind(CreditActivityInterface::class, function () {
            return new CreditActivityRepository(new CreditActivity());
        });

        $this->app->bind(RequestInterface::class, function () {
            return new RequestRepository(new Request());
        });

        $this->app->bind(CommissionInterface::class, function () {
            return new CommissionRepository(new Commission());
        });

        $this->app->bind(CommissionTempInterface::class, function () {
            return new CommissionTempRepository(new CommissionTemp());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        date_default_timezone_set('UTC');
        Schema::defaultStringLength(191);

        if (env('APP_ENV') === 'production') {
            \URL::forceScheme('https');
        }

//        dump(\session('token'));
        if (Schema::hasTable('settings')) {
            if (DB::table('settings')->where('code', 'timezone')->exists()) {
                Config::set([
                    'app.timezone' => setting('timezone')->value
                ]);
            }
        }
    }
}
