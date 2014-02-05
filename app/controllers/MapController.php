<?php

class MapController extends BaseController {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function showMap()
	{		
		return View::make('map');
	}

}
