<?php

namespace App\Controllers;

use App\Services\DB;
use App\Services\Helper;
use App\Services\Notification;
use App\Services\Redirect;

class Subject
{
	public static function allForClass()
	{
		$class = User::session()['class'];
		return (new DB)->select('subjects', '*')
			->where("class = {$class} and is_active = 1")
			->all();
	}

	public static function allActiveSubjects()
	{
		return (new DB)->select('subjects', '*')
			->where("is_active = 1")
			->all();
	}

	public static function allSubjects()
	{
		return (new DB)->select('subjects', '*')->all();
	}

	public function index()
	{
		return Helper::view('pages/subject/index');
	}

	public function create()
	{
		return Helper::view('pages/subject/create');
	}

	public function store($request)
	{
		$fields = ['name', 'code'];
		if (Helper::emptyFieldsErrorMsg($request, $fields)) {
			Redirect::redirect('/create-subject');
		}
		$insert = [
			'name' => $request['name'],
			'code' => $request['code'],
		];
		if (isset($request['is_active'])) {
			$insert['is_active'] = 1;
		}
		(new DB)->insert('subjects', $insert);
		Notification::notification('Successfully saved!', 'success');
		Redirect::redirect('/create-subject');
	}

	public function edit($id)
	{
		$getSubject = (new DB())->select('subjects')
			->where("id = {$id['id_subject']}")
			->get();
		return Helper::view('pages/subject/edit', ['subject' => $getSubject]);
	}

	public function update($request)
	{
		$fields = ['name', 'code'];
		if (Helper::emptyFieldsErrorMsg($request, $fields)) {
			Redirect::redirect('/create-subject');
		}
		$insert = [
			'name' => $request['name'],
			'code' => $request['code'],
			'is_active' => 0,
		];
		if (isset($request['is_active'])) {
			$insert['is_active'] = 1;
		}

		(new DB)->update('subjects', $insert, "id= {$request['subject_id']}");
		Notification::notification('Successfully updated!', 'success');
		Redirect::redirect('/subjects');
		dd($request);
	}

}