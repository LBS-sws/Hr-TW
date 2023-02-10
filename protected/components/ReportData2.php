<?php
class ReportData2 {
	public $criteria;
	
	
	protected function fieldExist($name) {
		return (strpos($this->criteria->fields,$name)!==false);
	}
	
	public function getSelectString() {
			if ($this->fieldExist('start_dt') || $this->fieldExist('end_dt') || $this->fieldExist('target_dt')) {
				if ($this->fieldExist('target_dt'))
					$rtn .= General::toDate($this->criteria->target_dt);
				else
					$rtn .= General::toDate($this->criteria->start_dt).' - '.General::toDate($this->criteria->end_dt);
				
			}
		}
	}
	
	public function getReportName() {
	
		return $this->getItemList('label');
	}

	public function getWidthList() {
		return $this->getItemList('width');
	}

	public function getAlignList() {
		return $this->getItemList('align');
	}

	protected function getItemList($item) {
		$rtn = array();
		$fields = $this->fields();
		foreach ($fields as $key=>$field) {
			$rtn[] = $field[$item];
		}
		return $rtn;
	}

	public function getLabel($field) {
		$fields = $this->fields();
		return (array_key_exists($fields,$field) ? $fields[$field]['align'] : 'L');
	}

	public function header_structure() {
		return array();
	}
	
	public function line_group() {
		return array();
	}

	public function fields() {
	public function groups() {
		return array();
	}
	
	public function subsections() {
		return array();
	}
	
	public function report_structure() {
		return array();
	}
	
?>