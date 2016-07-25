<?php

namespace Admin\Http\Controllers;

use Admin\Cuisine;
use Illuminate\Http\Request;

class CuisineController extends Controller
{
    /**
     * Create a cuisine.
     *
     * @param Request $request
     * @return Redirect
     */
    public function store(Request $request)
    {
        Cuisine::create($request->except('_token'));

        return redirect('settings')->with('message', 'Successfully created.');
    }

    /**
     * Update a cuisine.
     *
     * @return Redirect
     */
    public function update($id, Request $request)
    {
        if (Cuisine::find($id)->update($request->except('_token', '_method'))) {
            return redirect('settings')->with('message', 'Successfully updated.');
        }

        return redirect('settings')->with('message_error', 'Error while updating cuisine. Please try again.');
    }

    /**
     * Delete a cuisine
     *
     * @param integer $id
     * @return Redirect
     */
    public function destroy($id)
    {
        if (Cuisine::find($id)->delete()) {
            return redirect('settings')->with('message', 'Successfully deleted.');
        }

        return redirect('settings' . $id)->withInput()->with('message_error', 'Error while deleting cuisine. Please try again.');
    }
}
