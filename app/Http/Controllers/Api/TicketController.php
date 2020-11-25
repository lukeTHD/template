<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Message;
use App\Subject;
use App\Traits\PaginationTrait;

class TicketController extends Controller
{
    use PaginationTrait;

    public function __construct(Subject $subject, Message $message)
    {
        $this->subject = $subject;
        $this->message = $message;
    }

    public function index(Request $request)
    {
        if ($request->has('is_pagination') && $request->is_pagination) {
            $this->params = $request->all();
            $this->query = $this->subject->query();
            $this->field_search = ['content'];
            $this->with = ['user', 'messages'];
            $this->where = true;

            $this->setStatus('search', true);

            $results = $this->getResults();

            return response()->json([
                'meta' => $results[0],
                'data' => $results[1]
            ]);
        }
    }
    
    public function updateStatus(Request $request)
    {
        if ($request->ajax()) {
            $this->subject->where('id', $request['id'])->update(['status' => $request['status']]);
            return 'success';
        }
    }

    public function updateRowsStatus(Request $request)
    {//return $request->all();
        if ($request->ajax()) {
            $this->subject->whereIn('id', $request['data'])->update(['status' => $request['status']]);
            return 'success';
        }
    }

    public function insertMessage(Request $request)
    {
        if ($request->ajax()) {
            $data = [
                'subject_id' => $request['subject_id'],
                'user_id' => $request['user_id'],
                'content' => $request['content'],
            ];
            $message = $this->message->create($data);
            return $message;
        }
    }
}
