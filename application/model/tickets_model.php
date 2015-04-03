<?php
include "Base_Model.php";

class Tickets_Model Extends Base_Model
{
	public function showAllTickets()
	{
		$sql = "SELECT t.tid, t.title, c.name AS cname, p.name AS pname, l.name AS lname, t.insrt_tmst, t.last_mdfd_tmst FROM StTktInst AS t INNER JOIN StLfeCyclConf AS l ON t.life_cycl_id = l.life_cycl_id INNER JOIN StCatgConf AS c ON t.catg = c.cid INNER JOIN StPriMtxConf AS mtx ON t.aff_level = mtx.aff_level AND t.severity = mtx.severity INNER JOIN StPriConf AS p ON mtx.priority = p.priority WHERE t.logl_del = FALSE ORDER BY t.tid ASC";
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}

	public function addTicket()
	{
		$sql = "";
	}
}

?>