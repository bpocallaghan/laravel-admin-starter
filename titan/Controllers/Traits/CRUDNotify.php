<?php

namespace Titan\Controllers\Traits;

use Illuminate\Http\Request;
use Notify;

trait CRUDNotify
{
    /**
     * Get Model class name, add space before all capital letters
     *
     * @param $model
     * @return mixed
     */
    private function formatModelName($model)
    {
        return preg_replace('/(?<!\ )[A-Z]/', ' $0', class_basename($model));
    }

    /**
     * Create Entry
     *
     * @param $model
     * @param $inputs
     * @return mixed
     */
    public function createEntry($model, $inputs)
    {
        $row = $model::create($inputs);

        if ($row) {
            Notify::success('Successfully',
                'A new ' . $this->formatModelName($model) . ' has been created',
                'thumbs-up bounce animated');
        }
        else {
            Notify::error('Oops', 'Something went wrong', 'warning shake animated');
        }

        return $row;
    }

    /**
     * @param $model
     * @param $inputs
     * @return mixed
     */
    public function updateEntry($model, $inputs)
    {
        $response = $model->update($inputs);

        Notify::success('Successfully',
            'The ' . $this->formatModelName($model) . ' has been updated',
            'thumbs-up bounce animated');

        return $model;
    }

    /**
     * @param         $model
     * @param Request $request
     */
    public function deleteEntry($model, Request $request)
    {
        // check if ids match (cant type random ids)
        if ($request->get('_id') == $model->id) {
            if ($model->delete() >= 1) {
                Notify::success('Successfully',
                    'The ' . $this->formatModelName($model) . ' has been removed',
                    'thumbs-up bounce animated');
            }
            else {
                Notify::error('Oops',
                    'We could not find the ' . $this->formatModelName($model) . ' to delete',
                    'warning shake animated');
            }
        }
        else {
            Notify::error('Oops', 'The ' . $this->formatModelName($model) . ' id does not match',
                'warning shake animated');
        }
    }
}