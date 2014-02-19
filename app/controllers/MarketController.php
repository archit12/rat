<?php
class MarketController extends BaseController {
	public function index() {
		return View::make('market/market');
	}
}