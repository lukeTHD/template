<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Ticket extends Model
{

    use SoftDeletes;

    //

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'uid');
    }

    public function commissions()
    {
        return $this->hasMany(Commission::class, 'ticket_id');
    }

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }

    public function ticket_rewards()
    {
        return $this->hasMany(TicketReward::class, 'ticket_id');
    }

    public function lottery_activity()
    {
        return $this->hasOne(LotteryActivity::class, 'ticket_id');
    }

    public function prize()
    {
        return $this->belongsTo(GameConfig::class, 'prize_id');
    }

    public function lottery()
    {
        return $this->belongsTo(Lottery::class, 'lottery_id');
    }

    public function booking()
    {
        return $this->belongsTo(Ticket::class, 'booking_id');
    }

    public function addTickets($data, $game)
    {
        DB::beginTransaction();
        try {

            $booking = new Booking([
                'created_at' => now(),
                'total_price' => $data['total_price'],
                'total_quantity' => $data['total_quantity'],
                'uid' => auth()->user()->id
            ]);

            $booking->save();

            $data['tickets'] = collect($data['tickets'])->map(function ($value) use ($booking) {
                $value['booking_id'] = $booking->id;
                $value['picked'] = json_encode($value['picked']);
                return $value;
            })->toArray();

            foreach ($data['tickets'] as $ticket) {
                $this->addTicket($ticket, $game);
            }

            DB::commit();

            return $data['tickets'];

        } catch (\Exception $ex) {
            DB::rollback();
            throw new $ex;
        }
    }

    public function addTicket($data, $game)
    {

        $user = User::findOrFail($data['uid']);
        $old_value = $user->credit->value;
        $ticket = new Ticket($data);
        $ticket->save();
        $moneyLeft = (float)$user->credit->value - (float)$game->price;

        $user->credit()->update([
            'value' => $moneyLeft
        ]);
        $user->credit->credit_activities()->create([
            'credit_id' => $user->credit->id,
            'uid' => $data['uid'],
            'value' => (float)$game->price,
            'reason' => 'buy_ticket',
            'note' => 'Buy ticket id : ' . $ticket->id,
            'old_value' => $old_value,
            'type' => 'minus',
            'created_at' => now()
        ]);
        return $ticket;
    }
//
//    public function getCreatedAtAttribute($value)
//    {
//        $uid = 0;
//        if (auth()->check()) $uid = auth()->user()->id;
//        $format = setting('time_format', $uid)->value;
//        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format($format);
//    }

    public function getPickedAttribute($value)
    {
        return json_decode($value, true);
    }


}
