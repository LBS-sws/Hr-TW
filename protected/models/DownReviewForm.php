<?php

class DownReviewForm {
    protected $objPHPExcel;
    protected $objActSheet;
    protected $listArr=['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
    protected $row = 1;
    protected $sheetNum = 0;
    protected $model;
    protected $review_rows;
    protected $end_str;
    protected $end_num;

    protected $pro_str="";
    protected $userNum=0;

    public function __construct() {
        $phpExcelPath = Yii::getPathOfAlias('ext.phpexcel');
        //spl_autoload_unregister(array('YiiBase','autoload'));
        include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');

        $this->objPHPExcel = new PHPExcel();
//设置文档基本属性
        $objProps = $this->objPHPExcel->getProperties();
        $objProps->setCreator("Zeal Li");
        $objProps->setLastModifiedBy("Zeal Li");
        $objProps->setTitle("Office XLS Test Document");
        $objProps->setSubject("Office XLS Test Document, Demo");
        $objProps->setDescription("kol document, generated by PHPExcel.");
        $objProps->setKeywords("office excel PHPExcel");
        $objProps->setCategory("Test");

        $this->objActSheet = $this->objPHPExcel->setActiveSheetIndex(0); //填充表头
        $this->objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);      //字体大小
        //$this->objPHPExcel->disconnectWorksheets();
        //var_dump($this->objPHPExcel);die();
        //$this->objPHPExcel->getActiveSheet()->getStyle('A1:H8')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    }

    //設置起始行
    public function setStartRow($num){
        $this->row = $num;
    }

    //設置某行的內容
    public function setRowContent($row,$str,$endRow=0){
        $this->objActSheet->setCellValue($row,$str);
        if(!empty($endRow)){
            $this->objActSheet->mergeCells($row.":".$endRow);
        }
    }

    //設置規則提示
    public function setRulesArr($arr){
        for ($i = 0;$i<count($arr);$i++){
            $this->objActSheet->setCellValue("A".($i+1),$arr[$i]);
            $this->objActSheet->getStyle( "A".($i+1))->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
        }
    }

    protected function setWidthToArr($arr,$width){
        if(is_array($arr)){
            foreach ($arr as $str){
                $str = strtoupper($str);
                $this->objPHPExcel->getActiveSheet()->getColumnDimension($str)->setWidth($width);
            }
        }else{
            $str = strtoupper($arr);
            $this->objPHPExcel->getActiveSheet()->getColumnDimension($str)->setWidth($width);
        }
    }

    //設置excel背景顏色 cellColor('A',"D6D6D6") cellColor('B2',"D6D6D6") cellColor('C3:D4',"D6D6D6")
    protected function cellColor($cells,$color){
        $this->objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array(
                'rgb' => $color
            )
        ));
    }

    //設置頁頭數組(中央支援)
    protected function setExcelTopToSupport(){
        //設置表格寬度
        $this->setWidthToArr('A',8);
        $this->setWidthToArr('B',72);
        $this->setWidthToArr('C',20);
        $this->setWidthToArr('D',220);
        $this->end_str = "C";
        $this->end_num = 4;
        $this->setRowContent("A1","史伟莎员工评分制度表",$this->end_str."1");//
        $this->setBoxStyle("A1",true,18);//
        $this->setRowContent("A2","大中华中央技术支援组同事",$this->end_str."2");//
        $this->setBoxStyle("A2",true,18);//
        $this->setRowContent("A3","<<员工支援评分表>>",$this->end_str."3");//
        $this->setBoxStyle("A3",true,16);//
        $this->setRowContent("A4","去对每位员工进每评分，力求做到公平、公正、公开。",$this->end_str."4");//
        $this->setBoxStyle("A4");

        $this->setRowContent("A5","评分标准 (0至10分) :","C5");//
        $this->setRowContent("A6","10 - 表现卓越 (表现十分超卓，持续远超过公司期望)","C6");//
        $this->setRowContent("A7"," 9 - 表现优秀 (表现出色，超越公司的期望)","C7");//
        $this->setRowContent("A8"," 8 - 表现良好 (整体表现符合公司期望)","C8");//
        $this->setRowContent("A9"," 7 - 表现不俗 (整体表现十分稳定)","C9");//
        $this->setRowContent("A10"," 6 - 表现达标 (整体表现已达公司标准)","C10");//
        $this->setRowContent("A11"," 5 - 表现尚可 (表现努力，但仍未达公司标准)",$this->end_str."11");//
        $this->setRowContent("A12"," 4 - 表现欠佳 (表现不佳，整体表现不满意)",$this->end_str."12");//
        $this->setRowContent("A13"," 3 - 表现差劲 (表现差劣，与公司的标准相距甚大)",$this->end_str."13");//
        $this->setRowContent("A14"," 2 - 表现恶劣 (表现令人失望)",$this->end_str."14");//
        $this->setRowContent("A15"," 1 - 表现极度恶劣 (表现令人极度失望)",$this->end_str."15");//
        $this->setRowContent("A16"," 0 - 表现不值任何分数 (玩忽职守)",$this->end_str."16");//

        $arr = array(
            array("name"=>"支援员工姓名 :","key"=>"employee_name"),
            array("name"=>"职位 :","key"=>"position_name"),
            array("name"=>"服务类型 :","key"=>"service_type_name"),
            array("name"=>"支援开始时间 :","key"=>"apply_date"),
            array("name"=>"支援结束时间 :","key"=>"apply_end_date"),
            array("name"=>"支援城市 :","key"=>"city_name"),
            array("name"=>"评核日期 :","key"=>"lud"),
        );
        $this->printTable("A5:C16");

        $this->row = 17;
        foreach ($arr as $list){
            $this->row++;
            $this->setRowContent("A".$this->row,$list["name"],"B".$this->row);//
            $this->setBoxStyle("A".$this->row,true,0,"right");//
            $this->setRowContent("C".$this->row,$this->model[$list["key"]]);//
            $this->setBoxStyle("C".$this->row,true,0,"left");//
        }
        $this->printTable("A18:C".$this->row);

        $this->row++;
    }

    //設置頁頭數組(考核)
    protected function setExcelTop(){
        $rows = Yii::app()->db->createCommand()->select("*")->from("hr_review_h")
            ->where("review_id=:review_id",array(":review_id"=>$this->model->id))->queryAll();
        $this->review_rows = $rows;
        //設置表格寬度
        $this->setWidthToArr('A',3);
        $this->setWidthToArr('B',39);
        foreach ($this->review_rows as $i=>&$row){
            $this->model->resetRemarkList($row);
            $row["show_bool"] = $this->model->getShowBool($row);//是否顯示分數
            if(!$row["show_bool"]){
                $row["review_sum"]=0;
                $row["four_with_sum"]=0;
            }
            $row["tem_s_ist"] = json_decode($row["tem_s_ist"],true);
            $str = $this->getStrToNum($i+2);
            $this->setWidthToArr($str,41/(count($rows)+2));
        }
        $this->end_str = $this->getStrToNum(count($this->review_rows)+2);
        $this->setWidthToArr($this->end_str,41/(count($rows)+2));
        $this->end_str = $this->getStrToNum(count($this->review_rows)+3);
        $this->setWidthToArr($this->end_str,41/(count($rows)+2));
        $this->end_num = count($this->review_rows)+3;

        if($this->model->year_type == 1){
            if(Yii::app()->params['retire']===false){ //台灣地區
                $this->setRowContent("A1","史伟莎员工评分制度表 (1/".$this->model->year." - 6/".$this->model->year.")",$this->end_str."1");//年份
            }else{
                if($this->model->year <2020){
                    $this->setRowContent("A1","史伟莎员工评分制度表 (4/".$this->model->year." - 9/".$this->model->year.")",$this->end_str."1");//年份
                }elseif($this->model->year ==2020){
                    $this->setRowContent("A1","史伟莎员工评分制度表 (4/".$this->model->year." - 12/".$this->model->year.")",$this->end_str."1");//年份
                }else{
                    $this->setRowContent("A1","史伟莎员工评分制度表 (1/".$this->model->year." - 6/".$this->model->year.")",$this->end_str."1");//年份
                }
            }
        }else{
            if(Yii::app()->params['retire']===false) { //台灣地區
                $this->setRowContent("A1","史伟莎员工评分制度表 (7/".$this->model->year." - 12/".$this->model->year.")",$this->end_str."1");//年份
            }else{
                if($this->model->year <2020){
                    $this->setRowContent("A1","史伟莎员工评分制度表 (10/".$this->model->year." - 3/".($this->model->year+1).")",$this->end_str."1");//年份
                }else{
                    $this->setRowContent("A1","史伟莎员工评分制度表 (7/".$this->model->year." - 12/".$this->model->year.")",$this->end_str."1");//年份
                }
            }
        }
        $this->setBoxStyle("A1",true,18);//
        $this->setRowContent("A2",DeptForm::getDeptToId($this->model->department)." / ".$this->model->dept_name,$this->end_str."2");//員工職位
        $this->setBoxStyle("A2",true,16);//
        $this->setRowContent("A3","为配合采用差异化管理模式，公司每个部门都会根据自己部门的特点，制定了一套包括了有",$this->end_str."3");//
        $this->setBoxStyle("A3");
        $this->setRowContent("A4","主观评核的、客观评核的、有上司、旁线、及下属评核的全方位的，内容十分精细的，",$this->end_str."4");//
        $this->setBoxStyle("A4");
        $this->setRowContent("A5","包括了各种因素的，能真正反映每位员工的工作能力、心态、理念、个人表现的",$this->end_str."5");//
        $this->setBoxStyle("A5");
        $this->setRowContent("A6","<<员工表现评核机制>>",$this->end_str."6");//
        $this->setBoxStyle("A6",true,16);//
        $this->setRowContent("A7","去对每位员工进每评分，力求做到公平、公正、公开。",$this->end_str."7");//
        $this->setBoxStyle("A7");

        $this->setRowContent("A9","评分标准 (0至10分) :","B9");//
        $this->setRowContent("C9"," 5 - 表现尚可 (表现努力，但仍未达公司标准)",$this->end_str."9");//

        $this->setRowContent("A10","10 - 表现卓越 (表现十分超卓，持续远超过公司期望)","B10");//
        $this->setRowContent("C10"," 4 - 表现欠佳 (表现不佳，整体表现不满意)",$this->end_str."10");//

        $this->setRowContent("A11"," 9 - 表现优秀 (表现出色，超越公司的期望)","B11");//
        $this->setRowContent("C11"," 3 - 表现差劲 (表现差劣，与公司的标准相距甚大)",$this->end_str."11");//

        $this->setRowContent("A12"," 8 - 表现良好 (整体表现符合公司期望)","B12");//
        $this->setRowContent("C12"," 2 - 表现恶劣 (表现令人失望)",$this->end_str."12");//

        $this->setRowContent("A13"," 7 - 表现不俗 (整体表现十分稳定)","B13");//
        $this->setRowContent("C13"," 1 - 表现极度恶劣 (表现令人极度失望)",$this->end_str."13");//

        $this->setRowContent("A14"," 6 - 表现达标 (整体表现已达公司标准)","B14");//
        $this->setRowContent("C14"," 0 - 表现不值任何分数 (玩忽职守)",$this->end_str."14");//

        $this->setRowContent("A15","被评核之员工 :","B15");//
        $this->setBoxStyle("A15",true,0,"right");//
        $this->setRowContent("C15",$this->model->name,$this->end_str."15");//
        $this->setBoxStyle("C15",true,0,"left");//

        $this->setRowContent("A16","职位 :","B16");//
        $this->setBoxStyle("A16",true,0,"right");//
        $this->setRowContent("C16",$this->model->dept_name,$this->end_str."16");//
        $this->setBoxStyle("C16",true,0,"left");//

        $this->setRowContent("A17","入职日期 :","B17");//
        $this->setBoxStyle("A17",true,0,"right");//
        $this->setRowContent("C17",$this->model->entry_time,$this->end_str."17");//
        $this->setBoxStyle("C17",true,0,"left");//

        $this->setRowContent("A18","作出评核之员工 :","B18");//
        $this->setBoxStyle("A18",true,0,"right");//
        $this->setRowContent("C18",$this->model->name_list,$this->end_str."18");//
        $this->setBoxStyle("C18",true,0,"left");//
        $this->printTable("A15:".$this->end_str."18");

        $this->row = 18;
    }

    protected function setBoxStyle($str,$bold=false,$size=0,$align='center'){
        //PHPExcel_Style_Alignment::HORIZONTAL_CENTER
        $this->objPHPExcel->getActiveSheet()->getStyle($str)->getAlignment()->setHorizontal($align);
        if($bold){
            $this->objPHPExcel->getActiveSheet()->getStyle($str)->getFont()->setBold(true);
        }
        if(!empty($size)){
            $this->objPHPExcel->getActiveSheet()->getStyle($str)->getFont()->setSize($size);
        }
    }

    protected function setBoxStyleToRemark($html){
        //PHPExcel_Style_Alignment::HORIZONTAL_CENTER

        $this->setRowContent("A".$this->row,$html,$this->end_str.$this->row);//
        $this->objActSheet->getStyle("A".$this->row)->getAlignment()->setWrapText(true);
        $this->objPHPExcel->getActiveSheet()->getStyle("A".$this->row)->getAlignment()->setVertical('top');
        $this->objPHPExcel->getActiveSheet()->getRowDimension($this->row)->setRowHeight(120);
    }

    protected function getStrToNum($num){
        $arr = $this->listArr;
        if(count($arr)<=$num){
            $i = intval($num/count($arr))-1;
            $j = $num%count($arr);
            return $arr[$i].$arr[$j];
        }else{
            return $arr[$num];
        }
    }

    protected function setReviewHeader(){
        $this->row+=3;
        $this->setRowContent("A".$this->row,"表现因素(由主管评分) (%)","B".$this->row);//
        $this->setBoxStyle("A".$this->row,true);//
        foreach ($this->review_rows as $i=>$reviewRow){
            $str = $this->getStrToNum($i+2);
            $this->setRowContent($str.$this->row,$reviewRow["handle_per"]."%");//所佔百分比
            $this->setBoxStyle($str.$this->row,true);//
        }
        $this->row++;
        $this->setRowContent("A".$this->row,"被评核员工","B".$this->row);//
        $this->setBoxStyle("A".$this->row,true);//
        $this->setRowContent("C".$this->row,$this->model->name,$this->end_str.$this->row);//
        $this->setBoxStyle("C".$this->row,true,0);//
        $this->row++;
        $this->setRowContent("A".$this->row,"作出评核之员工","B".$this->row);//
        $this->setBoxStyle("A".$this->row,true);//
        foreach ($this->review_rows as $i=>$reviewRow){
            $str = $this->getStrToNum($i+2);
            $this->setRowContent($str.$this->row,$reviewRow["handle_name"]);//所佔百分比
            $this->setBoxStyle($str.$this->row,true);//
        }
        $this->setRowContent($this->end_str.$this->row,"总分");//
        $this->setBoxStyle($this->end_str.$this->row,true);//
    }

    protected function setReviewHeaderToSupport(){
        $this->row+=3;
        $this->setRowContent("A".$this->row,"序号");//
        $this->setBoxStyle("A".$this->row,true);//
        $this->setRowContent("B".$this->row,"项目");//
        $this->setBoxStyle("B".$this->row,true);//
        $this->setRowContent("C".$this->row,"评分");//
        $this->setBoxStyle("C".$this->row,true);//
    }


    protected function setRowBodyToSupport(){
        $tem_s_ist = $this->model->tem_s_ist;
        $this->pro_str = empty($tem_s_ist)?"":current($tem_s_ist)["code"];
        foreach ($tem_s_ist as $set_id => $proRow){
            $footArr = array(
                'sum'=>0,
                'num'=>0,
            );
            $sumNumber = count($proRow["list"])*10*$proRow['num_ratio'];//總分
            $footArr["sum"]+=$sumNumber;
            $this->setReviewHeaderToSupport();
            $tableBorder = "A".$this->row;
            $this->row++;
            $this->setRowContent("A".$this->row,$proRow["code"]);//
            $this->setBoxStyle("A".$this->row,true,0,"center");//
            $this->setRowContent("B".$this->row,$proRow["name"]);//
            $this->setBoxStyle("B".$this->row,true,0,"left");//
            $this->setRowContent("C".$this->row,$sumNumber);//
            $this->setBoxStyle("C".$this->row,true,0);//
            $this->cellColor("A".$this->row.":C".$this->row,"FFFF00");//
            $key = 0;
            foreach ($proRow["list"] as $row){
                $key++;
                $this->row++;
                $this->setRowContent("A".$this->row,$key);
                $this->setBoxStyle("A".$this->row,false,0,"center");//
                $this->setRowContent("B".$this->row,$row["name"]);
                $remark='';
                if(key_exists("value",$row)){
                    $proValue = intval($row["value"])*$proRow['num_ratio'];
                    $footArr['num']+=$proValue;
                    $this->userNum+=$proValue;
                }else{
                    $proValue = "";
                }
                if(key_exists("remark",$row)){
                    $remark = $row["remark"];
                }

                $this->setRowContent("C".$this->row,$proValue);//總分
                $this->setBoxStyle("C".$this->row,false,0,"center");//
                $this->setRowContent("D".$this->row,$remark);//備註
                $this->objPHPExcel->getActiveSheet()->getStyle("D".$this->row)->getAlignment()->setWrapText(true);
                $this->setBoxStyle("C".$this->row,false,0,"center");//
            }

            $this->setReviewFootToSupport($footArr);
            $tableBorder .= ":C".$this->row;
            $this->printTable($tableBorder);
        }
        $this->pro_str.= (empty($tem_s_ist)||empty($proRow))?"":" - ".$proRow["code"];
    }


    protected function setRowBody(){
        $remarkStr = $this->getStrToNum($this->end_num+1);
        foreach ($this->model->tem_s_ist as $set_id => $proRow){
            $footArr = array(
                'sum'=>array(),
                'num'=>array(),
                'pro'=>array(),
            );
            $sumNumber = count($proRow["list"])*10*$proRow['num_ratio'];//總分
            $tableBorder = "A".($this->row+3);
            $this->setReviewHeader();
            $this->row++;
            $this->setRowContent("A".$this->row,$proRow["code"]);//
            $this->setBoxStyle("A".$this->row,true,0,"left");//
            $this->setRowContent("B".$this->row,$proRow["name"]);//
            $this->setBoxStyle("B".$this->row,true,0,"left");//
            for ($i=0;$i<count($this->review_rows);$i++){
                $str = $this->getStrToNum($i+2);
                $this->setRowContent($str.$this->row,$sumNumber);//
                $this->setBoxStyle($str.$this->row,true,0);//
                $footArr['sum'][$i]=$sumNumber;
                $footArr['num'][$i]=0;
                $footArr['pro'][$i]=$this->review_rows[$i]['handle_per'];
            }
            $this->setRowContent($this->end_str.$this->row,$sumNumber*count($this->review_rows));//
            $this->setBoxStyle($this->end_str.$this->row,true,0);//
            $this->cellColor("A".$this->row.":".$this->end_str.$this->row,"FFFF00");//
            $key = 0;
            foreach ($proRow["list"] as $row){
                $key++;
                $this->row++;
                $this->setRowContent("A".$this->row,$key);
                $this->setRowContent("B".$this->row,$row["name"]);
                $sum = 0;
                $remark='';
                foreach ($this->review_rows as $i=>$reviewRow){
                    $str = $this->getStrToNum($i+2);
                    if($reviewRow["show_bool"]){
                        $value = $reviewRow["tem_s_ist"][$set_id]['list'][$row['id']]["value"];
                        $value*=$proRow['num_ratio'];
                        if(isset($reviewRow["tem_s_ist"][$set_id]['list'][$row['id']]["remark"])){
                            $remark.=$remark==""?"":"\n";
                            $remark.=$reviewRow["handle_name"]."：".$reviewRow["tem_s_ist"][$set_id]['list'][$row['id']]["remark"];
                        }
                    }else{
                        $value = 0;
                    }
                    $footArr['num'][$i]+=$value;
                    $sum+=$value;
                    $this->setRowContent($str.$this->row,$value);//
                    $this->setBoxStyle($str.$this->row,false,0,"center");//
                }
                $this->setRowContent($this->end_str.$this->row,$sum);//總分
                $this->setRowContent($remarkStr.$this->row,$remark);//備註
                $this->objPHPExcel->getActiveSheet()->getStyle($remarkStr.$this->row)->getAlignment()->setWrapText(true);
                $this->setBoxStyle($this->end_str.$this->row,false,0,"center");//
            }

            $this->setReviewFoot($footArr);
            $tableBorder .= ":".$this->end_str.$this->row;
            $this->printTable($tableBorder);
        }
    }

    protected function setReviewFootToSupport($footArr,$bool=false){
        $name = $bool?"(".$this->pro_str.")":"";
        $arr = array(
            array('code'=>'A','name'=>"项目总分$name",'value'=>'sum','sumBool'=>true,'bold'=>true),
            array('code'=>'B','name'=>"评核项目得总分",'value'=>'num','sumBool'=>true,'bold'=>true),
            array('code'=>'C','name'=>"百分比得分(以一百分为满分) B/A*100",'value'=>'c','sumBool'=>false,'bold'=>true),
        );
        $this->cellColor("A".($this->row+count($arr)).":".$this->end_str.($this->row+count($arr)),"FFCC00");//
        $footArr["c"] = empty($footArr["sum"])?0:sprintf("%.2f",$footArr["num"]/$footArr["sum"]*100);
        foreach ($arr as $item){
            $this->row++;
            $this->setRowContent("A".$this->row,$item['code']);
            $this->setBoxStyle("A".$this->row,$item['bold'],0,"center");//
            $this->setRowContent("B".$this->row,$item['name']);
            $this->setBoxStyle("B".$this->row,$item['bold'],0,"left");//
            $this->setRowContent("C".$this->row,$footArr[$item["value"]]);
            $this->setBoxStyle("C".$this->row,$item['bold'],0,"center");
        }
        //$this->setBoxStyle("A".$this->row,true);
    }

    protected function setReviewFoot($footArr,$bool=false,$pro=90){
        $arr = array(
            array('code'=>'A','name'=>"项目总分",'value'=>'sum','sumBool'=>true,'bold'=>true),
            array('code'=>'B','name'=>"评核项目得总分",'value'=>'num','sumBool'=>true,'bold'=>true),
            array('code'=>'C','name'=>"百分比得分(以一百分为满分) B/A*100",'value'=>'c','sumBool'=>false,'bold'=>true),
            array('code'=>'D','name'=>"评分比率",'value'=>'pro','sumBool'=>false,'bold'=>true),
            array('code'=>'E','name'=>"所占比率得分 (Ｃ x D)",'value'=>'e','sumBool'=>true,'bold'=>true),
        );
        if($bool){
            $arr[] =array('code'=>'F','name'=>"所占比率得分（E*$pro%）",'value'=>'f','sumBool'=>true,'bold'=>true);
        }
        $this->cellColor("A".($this->row+count($arr)).":".$this->end_str.($this->row+count($arr)),"FFCC00");//
        foreach ($arr as $item){
            $this->row++;
            $this->setRowContent("A".$this->row,$item['code']);
            $this->setBoxStyle("A".$this->row,$item['bold'],0,"left");//
            $this->setRowContent("B".$this->row,$item['name']);
            $this->setBoxStyle("B".$this->row,$item['bold'],0,"left");//
            $sum = 0;
            foreach ($this->review_rows as $i=>$reviewRow){
                $str = $this->getStrToNum($i+2);
                if(key_exists($item["value"],$footArr)){
                    $value = $footArr[$item['value']][$i];
                }else{
                    switch ($item["code"]){
                        case "C":
                            $value = $footArr['num'][$i]/$footArr['sum'][$i]*100;
                            $value = sprintf("%.2f",$value);
                            break;
                        case "E":
                            $value = ($footArr['num'][$i]/$footArr['sum'][$i])*$footArr['pro'][$i];
                            $value = sprintf("%.2f",$value);
                            break;
                        case "F":
                            $value = ($footArr['num'][$i]/$footArr['sum'][$i])*$footArr['pro'][$i]*($pro/100);
                            $value = sprintf("%.2f",$value);
                            break;
                        default:
                            $value=0;
                    }
                }
                $sum+=$value;
                if($item["code"]=="D"){
                    $value.="%";
                }
                $this->setRowContent($str.$this->row,$value);//
                $this->setBoxStyle($str.$this->row,$item['bold'],0,"center");//
            }
            if($item['sumBool']){
                $this->setRowContent($this->end_str.$this->row,$sum);//總分
                $this->setBoxStyle($this->end_str.$this->row,$item['bold'],0,"center");//
            }
        }
        //$this->setBoxStyle("A".$this->row,true);
    }

    protected function setReviewFootTwo($footArr){
        $afterStr = $this->getStrToNum($this->end_num-1);
        $this->setReviewFoot($footArr,true,85);
        $this->row++;
        $this->setRowContent("A".$this->row,"出勤率得分 (15%)",$this->end_str.$this->row);//
        $this->setBoxStyle("A".$this->row,true,0,"left");//
        $this->row++;
        $this->setRowContent("A".$this->row,"G");//
        $this->setRowContent("B".$this->row,"总病假及事假天数");//
        $this->setRowContent("C".$this->row,"",$afterStr.$this->row);//
        $this->setRowContent($this->end_str.$this->row,$this->model->change_num);//
        $this->setBoxStyle($this->end_str.$this->row,false,0);//
        $this->row++;
        $this->setRowContent("A".$this->row,"H");//
        $this->setBoxStyle("A".$this->row,true,0,"left");//
        $this->setRowContent("B".$this->row,"出勤率得分");//
        $this->setBoxStyle("B".$this->row,true,0,"left");//
        $this->setRowContent("C".$this->row,"",$afterStr.$this->row);//
        $value = 15-($this->model->change_num*0.5);
        $value = $value<0?0:$value;
        $value = sprintf("%.2f",$value);
        $this->setRowContent($this->end_str.$this->row,$value);//
        $this->setBoxStyle($this->end_str.$this->row,true,0);//
        $this->cellColor("A".($this->row).":".$this->end_str.($this->row),"FFCC00");//
        $this->row++;
        $this->setRowContent("A".$this->row,"总得分 (100%)",$this->end_str.$this->row);//
        $this->setBoxStyle("A".$this->row,true,0,"left");//
        $this->row++;
        $this->setRowContent("A".$this->row,"J");//
        $this->setBoxStyle("A".$this->row,true,0,"left");//
        $this->setRowContent("B".$this->row,"百分比得分(以一百分为满分) (F + H)");//
        $this->setBoxStyle("B".$this->row,true,0,"left");//
        $this->setRowContent("C".$this->row,"",$afterStr.$this->row);//
        $this->setRowContent($this->end_str.$this->row,$this->model->review_sum);//
        $this->setBoxStyle($this->end_str.$this->row,true,0);//
        $this->cellColor("A".($this->row).":".$this->end_str.($this->row),"FFCC00");//
        //$this->setBoxStyle("A".$this->row,true);
    }

    protected function setReviewFootFour(){
        $footArr = array(
            'sum'=>array(),
            'num'=>array(),
            'pro'=>array(),
        );
        $footArrBody=$footArr;
        foreach ($this->review_rows as $i=> $row){
            $footArrBody['sum'][$i] = $row["tem_sum"]*10-$row["four_with_count"]*10;
            $footArrBody['num'][$i] = $row["review_sum"]-$row["four_with_sum"];
            $footArrBody['pro'][$i] = $row["handle_per"];
            $footArr['sum'][$i] = $row["four_with_count"]*10;
            $footArr['num'][$i] = $row["four_with_sum"];
            $footArr['pro'][$i] = $row["handle_per"];
        }
        $this->setReviewFoot($footArrBody,true);
        $this->row++;
        $this->setRowContent("A".$this->row,"“四用”之得分 (10%)",$this->end_str.$this->row);//
        $this->setBoxStyle("A".$this->row,true,0,"left");//

        $arr = array(
            array('code'=>'G','name'=>"项目总分",'value'=>'sum','sumBool'=>true,'bold'=>false),
            array('code'=>'H','name'=>"评核项目得总分",'value'=>'num','sumBool'=>true,'bold'=>false),
            array('code'=>'J','name'=>"百分比得分(以一百分为满分) H/G*100",'value'=>'c','sumBool'=>false,'bold'=>false),
            array('code'=>'K','name'=>"评分比率",'value'=>'pro','sumBool'=>false,'bold'=>false),
            array('code'=>'L','name'=>"所占比率得分 (J x K)",'value'=>'e','sumBool'=>true,'bold'=>true),
            array('code'=>'M','name'=>"“四用”总得分（L*10%）",'value'=>'e','sumBool'=>true,'bold'=>true),
        );
        $this->cellColor("A".($this->row+6).":".$this->end_str.($this->row+6),"FFCC00");//
        foreach ($arr as $item){
            $this->row++;
            $this->setRowContent("A".$this->row,$item['code']);
            $this->setBoxStyle("A".$this->row,$item['bold'],0,"left");//
            $this->setRowContent("B".$this->row,$item['name']);
            $this->setBoxStyle("B".$this->row,$item['bold'],0,"left");//
            $sum = 0;
            foreach ($this->review_rows as $i=>$reviewRow){
                $str = $this->getStrToNum($i+2);
                if(key_exists($item["value"],$footArr)){
                    $value = $footArr[$item['value']][$i];
                }else{
                    switch ($item["code"]){
                        case "J":
                            $value = $footArr['num'][$i]/$footArr['sum'][$i]*100;
                            $value = sprintf("%.2f",$value);
                            break;
                        case "L":
                            $value = ($footArr['num'][$i]/$footArr['sum'][$i])*$footArr['pro'][$i];
                            $value = sprintf("%.2f",$value);
                            break;
                        case "M":
                            $value = (($footArr['num'][$i]/$footArr['sum'][$i])*$footArr['pro'][$i])*0.1;
                            $value = sprintf("%.2f",$value);
                            break;
                        default:
                            $value=0;
                    }
                }
                $sum+=$value;
                if($item["code"]=="K"){
                    $value.="%";
                }
                $this->setRowContent($str.$this->row,$value);//
                $this->setBoxStyle($str.$this->row,$item['bold'],0,"center");//
            }
            if($item['sumBool']){
                $this->setRowContent($this->end_str.$this->row,$sum);//總分
                $this->setBoxStyle($this->end_str.$this->row,$item['bold'],0,"center");//
            }
        }
        //$this->setBoxStyle("A".$this->row,true);
    }

    protected function getRemarkHtml($customer_id){
        $html = "";
        $rows = Yii::app()->db->createCommand()->select("a.remark,b.disp_name,a.lcd")->from("sev_remark_list a")
            ->leftJoin("sec_user b","a.lcu = b.username")
            ->where("a.customer_id=:customer_id",array(':customer_id'=>$customer_id))->order("a.lcd desc")->queryAll();

        if($rows){
            $num = 0;
            $bool = count($rows)>1?true:false;
            foreach ($rows as $row){
                $num++;
                if($num!==1){
                    $html.="\r\n";
                }
                $serial = $bool?"($num)、":"";
                $html.="$serial ".htmlspecialchars_decode($row["remark"])." - ".$row["disp_name"]." - ".$row["lcd"];
            }
        }
        return $html;
    }


    //繪製表格
    protected function setExcelFootToSupport(){
        $footArr = array(
            'sum'=>$this->model->tem_sum*10,
            'num'=>$this->userNum,
            'c'=>$this->model->review_sum,
        );
        $this->row+=3;
        $tableBorder = "A".$this->row;
        $this->setRowContent("A".$this->row,"评核总得分","C".$this->row);//
        $this->setBoxStyle("A".$this->row,true,0,"center");//
        $this->row++;
        $this->setRowContent("A".$this->row,"季度评核得分 (100%)","C".$this->row);//
        $this->setBoxStyle("A".$this->row,false,0,"left");//
        $bgColor = "A".$this->row;

        $this->setReviewFootToSupport($footArr,true);
        $tableBorder .= ":C".$this->row;
        $this->cellColor($bgColor.":C".($this->row-1),"FFFF00");//
        $this->printTable($tableBorder);
    }


    //繪製表格
    protected function setExcelFoot(){
        $tableBorder = "A".($this->row+3);
        $footArr = array(
            'sum'=>array(),
            'num'=>array(),
            'pro'=>array(),
        );
        foreach ($this->review_rows as $i=> $row){
            $footArr['sum'][$i] = $row["tem_sum"]*10;
            $footArr['num'][$i] = $row["review_sum"];
            $footArr['pro'][$i] = $row["handle_per"];
        }

        switch ($this->model->review_type){
            case 2: //技術員
                $this->setReviewHeader();
                $this->row++;
                $this->setRowContent("A".$this->row,"季度评核得分 (85%)",$this->end_str.$this->row);//
                $this->setBoxStyle("A".$this->row,true,0,"left");//
                $this->setReviewFootTwo($footArr);
                break;
            case 3://銷售
                $footArr['sum'][]=10;
                $footArr['num'][]=$this->model->change_num;
                $footArr['pro'][]=70;
                $this->review_rows[]=array("handle_name"=>"实质销售成绩	","handle_per"=>70);
                $this->setReviewHeader();
                $this->row++;
                $this->setRowContent("A".$this->row,"季度评核得分 (100%)",$this->end_str.$this->row);//
                $this->setBoxStyle("A".$this->row,true,0,"left");//
                $this->setReviewFoot($footArr);
                break;
            case 4://地區主管
                $this->setReviewHeader();
                $this->row++;
                $this->setRowContent("A".$this->row,"评核项目得分 (90%)",$this->end_str.$this->row);//
                $this->setBoxStyle("A".$this->row,true,0,"left");//
                $this->setReviewFootFour();
                break;
            default:
                $this->setReviewHeader();
                $this->row++;
                $this->setRowContent("A".$this->row,"季度评核得分 (100%)",$this->end_str.$this->row);//
                $this->setReviewFoot($footArr);
        }
        $this->setFootTotal();
        $tableBorder .= ":".$this->end_str.$this->row;
        $this->printTable($tableBorder);
    }

    protected function setFootTotal(){
        $afterStr = $this->getStrToNum($this->end_num-1);
        $this->row++;
        $this->setRowContent("A".$this->row,"评核总得分",$afterStr.$this->row);//
        $this->setBoxStyle("A".$this->row,true,0,"right");//
        $this->setRowContent($this->end_str.$this->row,$this->model->review_sum);//
        $this->setBoxStyle($this->end_str.$this->row,true);//
        $this->cellColor("A".$this->row.":".$this->end_str.$this->row,"FFCC00");//
        $arr = $this->model->getReviewLeave();
        $this->row++;
        $this->setRowContent("A".$this->row,$arr["str"],$afterStr.$this->row);//
        $this->setBoxStyle("A".$this->row,true,0,"right");//
        $this->setRowContent($this->end_str.$this->row,$arr["leave"]);//
        $this->setBoxStyle($this->end_str.$this->row,true);//
        $this->cellColor("A".$this->row.":".$this->end_str.$this->row,"FFCC00");//
    }


    //繪製表格
    protected function setRemarkFoot(){
        $afterStr = $this->getStrToNum($this->end_num-1);
        $this->row+=2;
        $this->setRowContent("A".$this->row,"总表现评分 : 总分以百分比计算，评级如下 :",$this->end_str.$this->row);//
        $tableBorder = "A".($this->row+1);
        $arr = array(
            array("one"=>"评分级别标准","two"=>"排 名","three"=>"评 级"),
            array("one"=>"评核得分经高低差异化后评为第一级","two"=>"Top 20%","three"=>"I"),
            array("one"=>"评核得分经高低差异化后评为第二级","two"=>"21 - 40%","three"=>"II"),
            array("one"=>"评核得分经高低差异化后评为第三级","two"=>"41 - 70%","three"=>"III"),
            array("one"=>"评核得分经高低差异化后评为第四级","two"=>"71 - 90%","three"=>"IV"),
            array("one"=>"评核得分经高低差异化后评为第五级","two"=>"Bottom 10%","three"=>"V"),
        );
        foreach ($arr as $item){
            $this->row++;
            $this->setRowContent("A".$this->row,$item["one"],"B".$this->row);//
            $this->setBoxStyle("A".$this->row);
            $this->setRowContent("C".$this->row,$item["two"],$afterStr.$this->row);//
            $this->setBoxStyle("C".$this->row);
            $this->setRowContent($this->end_str.$this->row,$item["three"]);//
            $this->setBoxStyle($this->end_str.$this->row);
        }
        $tableBorder .= ":".$this->end_str.$this->row;
        $this->printTable($tableBorder);

        $this->row+=2;
        $tableBorder = "A".$this->row;
        $tableBorder .= ":".$this->end_str.$this->row;
        $html = "自我功绩(由雇员填写) : 雇员可就以上所有项目，先加上来申报自己于本评核月份之功绩\r\n";
        $html.=htmlspecialchars_decode($this->model->employee_remark);
        $this->setBoxStyleToRemark($html);//
        $this->printTable($tableBorder);

        $this->row+=2;
        $tableBorder = "A".$this->row;
        $tableBorder .= ":".$this->end_str.$this->row;
        $html = "其他功绩/资格(由主管填写) -任何未曾于以上提及过的表现，均能于此方格内补充\r\n";
        $html.=htmlspecialchars_decode($this->model->review_remark);
        $this->setBoxStyleToRemark($html);//
        $this->printTable($tableBorder);

        $this->row+=2;
        $tableBorder = "A".$this->row;
        $tableBorder .= ":".$this->end_str.$this->row;
        $html = "雇员表现之长处 :\r\n";
        $html.=htmlspecialchars_decode($this->model->strengths);
        $this->setBoxStyleToRemark($html);//
        $this->printTable($tableBorder);

        $this->row+=2;
        $tableBorder = "A".$this->row;
        $tableBorder .= ":".$this->end_str.$this->row;
        $html = "雇员工作目标 :\r\n";
        $html.=htmlspecialchars_decode($this->model->target);
        $this->setBoxStyleToRemark($html);//
        $this->printTable($tableBorder);

        $this->row+=2;
        $tableBorder = "A".$this->row;
        $tableBorder .= ":".$this->end_str.$this->row;
        $html = "自从上一次评估后的任何改善进度 :\r\n";
        $html.=htmlspecialchars_decode($this->model->improve);
        $this->setBoxStyleToRemark($html);//
        $this->printTable($tableBorder);
    }

    //繪製表格
    protected function printTable($str){
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                ),
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THICK
                ),
            )
        );
        $this->objActSheet->getStyle($str)->applyFromArray($styleArray);
    }

    //添加新的sheet
    public function addNewSheet($sheetName=""){
        $this->sheetNum++;
        $this->objPHPExcel->createSheet();
        $this->objActSheet = $this->objPHPExcel->setActiveSheetIndex($this->sheetNum);
        if(!empty($sheetName)){
            $this->objActSheet->setTitle($sheetName);
        }
    }


    //設置sheet的名字
    public function setSheetName($sheetName){
        $this->objPHPExcel->setActiveSheetIndexByName($sheetName);
        //$this->objPHPExcel->getActiveSheet()->setTitle( 'Invoice');
    }

    public function setRowExcel($model){
        $this->model = $model;
        set_time_limit(0);

        $this->setExcelTop();
        $this->setRowBody();
        $this->setExcelFoot();

        $this->setRemarkFoot();
    }

    public function setRowExcelToSupport($model){
        $this->model = $model;
        $this->review_rows = array();
        set_time_limit(0);

        $this->setExcelTopToSupport();
        $this->setRowBodyToSupport();
        $this->setExcelFootToSupport();
    }

    //輸出excel表格
    public function outDownExcel($fileName){
        ob_end_clean();//清除缓冲区,避免乱码
        header("Content-Type: application/vnd.ms-excel; charset=utf-8");
        header('Content-Disposition: attachment;filename='.$fileName);
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel,'Excel5');
        $objWriter->save('php://output');
        //exit;
    }

    //生成excel表格
    public function saveExcel($url){
        $url=Yii::app()->basePath."/../$url";
        if (file_exists($url)){
            unlink($url);
        }
        $excel = new PHPExcel_Writer_Excel2007();
        $excel->setPHPExcel($this->objPHPExcel);
        $excel->save($url);
    }
}
?>