<?php

namespace Admin\Http\Controllers;

use Admin\BlurbCategory;
use Illuminate\Http\Request;

class BlurbCategoryController extends Controller
{
    /**
     * Create a blurb category.
     *
     * @param Request $request
     * @return Redirect
     */
    public function store(Request $request)
    {
        BlurbCategory::create($request->except('_token'));

        return redirect('settings')->with('message_blurb_category', 'Successfully created.');
    }

    /**
     * Update a blurb category.
     *
     * @return Redirect
     */
    public function update($id, Request $request)
    {
        if (BlurbCategory::find($id)->update($request->except('_token', '_method'))) {
            return redirect('settings')->with('message_blurb_category', 'Successfully updated.');
        }

        return redirect('settings')->with('message_blurb_category', 'Error while updating blurb category. Please try again.');
    }

    /**
     * Delete a blurb category
     *
     * @param integer $id
     * @return Redirect
     */
    public function destroy($id)
    {
        if (BlurbCategory::find($id)->delete()) {
            return redirect('settings')->with('message_blurb_category', 'Successfully deleted.');
        }

        return redirect('settings' . $id)->withInput()->with('message_blurb_category', 'Error while deleting blurb category. Please try again.');
    }
}
