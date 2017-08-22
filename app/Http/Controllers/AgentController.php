<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AgentController extends Controller
{

	/**
	 *agentOrderList
	 *
	 * Retrieve all available products in system into different categories
	 * @param $farmer_id: id of the farmer to be retrieved for
	 * @return array of products in its categories 
	 */

	public function agentOrderList($agent_id)
	{
		return 0;
	}
}
