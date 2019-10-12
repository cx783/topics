<?php

namespace App\Actions;

use App\Http\Resources\Topic;
use Lorisleiva\Actions\Action;

class CreateNewTopic extends Action
{
    /**
     * Determine if the user is authorized to make this action.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the action.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'body' => ['required', 'string']
        ];
    }

    /**
     * Execute the action and return a result.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->user()->topics()->create($this->validated());
    }

    public function htmlResponse($result, $request)
    {
        return back()->with('message.success', 'Topic was created');
    }

    public function jsonResponse($result, $request)
    {
        return new Topic($result);
    }
}
