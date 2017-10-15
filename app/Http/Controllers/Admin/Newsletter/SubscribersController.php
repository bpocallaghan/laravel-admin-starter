<?php

namespace App\Http\Controllers\Admin\Newsletter;

use Redirect;
use App\Http\Requests;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class SubscribersController extends AdminController
{
	/**
	 * Display a listing of newsletter_user.
	 *
	 * @return Response
	 */
	public function index()
	{
		save_resource_url();

		return $this->view('newsletters.subscribers.index')->with('items', NewsletterSubscriber::all());
	}

	/**
	 * Show the form for creating a new newsletter_user.
	 *
	 * @return Response
	 */
	public function create()
	{
		return $this->view('newsletters.subscribers.create_edit');
	}

	/**
	 * Store a newly created newsletter_user in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$attributes = request()->validate(NewsletterSubscriber::$rules, NewsletterSubscriber::$messages);

        $subscriber = $this->createEntry(NewsletterSubscriber::class, $attributes);

        return redirect_to_resource();
	}

	/**
	 * Display the specified newsletter_user.
	 *
	 * @param NewsletterSubscriber $subscriber
	 * @return Response
	 */
	public function show(NewsletterSubscriber $subscriber)
	{
		return $this->view('newsletters.subscribers.show')->with('item', $subscriber);
	}

	/**
	 * Show the form for editing the specified newsletter_user.
	 *
	 * @param NewsletterSubscriber $subscriber
     * @return Response
     */
    public function edit(NewsletterSubscriber $subscriber)
	{
		return $this->view('newsletters.subscribers.create_edit')->with('item', $subscriber);
	}

	/**
	 * Update the specified newsletter_user in storage.
	 *
	 * @param NewsletterSubscriber $subscriber
     * @return Response
     */
    public function update(NewsletterSubscriber $subscriber)
	{
		$attributes = request()->validate(NewsletterSubscriber::$rules, NewsletterSubscriber::$messages);

        $subscriber = $this->updateEntry($subscriber, $attributes);

        return redirect_to_resource();
	}

	/**
	 * Remove the specified newsletter_user from storage.
	 *
	 * @param NewsletterSubscriber $subscriber
	 * @return Response
	 */
	public function destroy(NewsletterSubscriber $subscriber)
	{
		$this->deleteEntry($subscriber, request());

        return redirect_to_resource();
	}
}
