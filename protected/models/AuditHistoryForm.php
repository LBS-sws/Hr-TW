<?php

/**
 * UserForm class.
 * UserForm is the data structure for keeping
 * user form data. It is used by the 'user' action of 'SiteController'.
 */
class AuditHistoryForm extends CFormModel
{
	/* User Fields */
	public $employee_id;
	public $id;
	public $name;
	public $city;
	public $code;
    public $sex;
	public $staff_id;
	public $company_id;
    public $address;
    public $address_code;
    public $contact_address;
    public $contact_address_code;
	public $phone;
    public $phone2;//緊急電話
	public $contract_id;
	public $user_card;
	public $department;
	public $position;
	public $wage;
	public $time=1;
	public $start_time;
	public $end_time;
	public $test_start_time;
	public $test_end_time;
	public $test_wage;
	public $word_status=1;
	public $test_type=1;
	public $word_html="";
    public $staff_status = 1;
    public $entry_time;//入職時間
    public $birth_time;//出生日期
    public $age;//年齡
    public $health;//身體狀況
    public $education;//學歷
    public $experience;//工作經驗
    public $english;//外語水平
    public $technology;//技術水平
    public $other;//其它說明
    public $year_day;//年假
    public $email;//員工郵箱
    public $ject_remark;//拒絕備註
    public $remark;//備註
    public $price1;//每月工資
    public $price2;//加班工資
    public $price3;//每月補貼
    public $image_user;//員工照片
    public $image_code;//身份證照片
    public $image_work;//工作證明照片
    public $image_other;//其它照片
    public $ld_card;//勞動保障卡號
    public $sb_card;//社保卡號
    public $jj_card;//公積金卡號
    public $update_remark;//員工修改備註
    public $operation;//員工修改備註
    public $historyList;//員工歷史
    public $staff_type;//员工类别
    public $staff_leader;//队长/组长
    public $test_length;//
    public $attachment="";//附件
    public $nation;//民族
    public $household;//户籍类型
    public $empoyment_code;//就业登记证号
    public $social_code;//社会保障卡号
    public $fix_time=0;//合同類型
    public $opr_type;//合同類型
    public $leave_time;//離職時間
    public $leave_reason;//離職原因
    public $user_card_date;//身份证有效期
    public $emergency_user;//紧急联络人姓名
    public $emergency_phone;//紧急联络人手机号
    public $change_city;//調職城市
    public $code_old;//員工編號（舊）
    public $group_type;//員工編號（舊）
    public $effect_time;//生效日期
    public $wechat;//微信賬號
    public $recommend_user;//推荐人
    public $urgency_card;//緊急聯繫人身份證
    public $no_of_attm = array(
        'employee'=>0
    );
    public $docType = 'EMPLOYEE';
    public $docMasterId = array(
        'employee'=>0
    );
    public $files;
    public $removeFileId = array(
        'employee'=>0
    );
	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
            'id'=>Yii::t('staff','Record ID'),
            'code'=>Yii::t('contract','Employee Code'),
            'sex'=>Yii::t('contract','Sex'),
            'age'=>Yii::t('contract','Age'),
            'birth_time'=>Yii::t('contract','Birth Date'),
            'name'=>Yii::t('contract','Employee Name'),
            'staff_id'=>Yii::t('contract','Employee Belong'),
            'company_id'=>Yii::t('contract','Employee Contract Belong'),
            'contract_id'=>Yii::t('contract','Employee Contract'),
            'address'=>Yii::t('contract','Old Address'),
            'contact_address'=>Yii::t('contract','Contact Address'),
            'phone'=>Yii::t('contract','Employee Phone'),
            'phone2'=>Yii::t('contract','Emergency call'),
            'user_card'=>Yii::t('contract','ID Card'),
            'department'=>Yii::t('contract','Department'),
            'position'=>Yii::t('contract','Position'),
            'wage'=>Yii::t('contract','Contract Pay'),
            'time'=>Yii::t('contract','Contract Time'),
            'start_time'=>Yii::t('contract','Contract Start Time'),
            'end_time'=>Yii::t('contract','Contract End Time'),
            'test_type'=>Yii::t('contract','Probation Type'),
            'test_time'=>Yii::t('contract','Probation Time'),
            'test_start_time'=>Yii::t('contract','Probation Start Time'),
            'test_end_time'=>Yii::t('contract','Probation End Time'),
            'test_wage'=>Yii::t('contract','Probation Wage'),
            'entry_time'=>Yii::t('contract','Entry Time'),
            'health'=>Yii::t('contract','Physical condition'),
            'education'=>Yii::t('contract','Degree level'),
            'experience'=>Yii::t('contract','Work experience'),
            'english'=>Yii::t('contract','Foreign language level'),
            'technology'=>Yii::t('contract','Technical level'),
            'other'=>Yii::t('contract','Other'),
            'year_day'=>Yii::t('contract','Annual leave'),
            'email'=>Yii::t('contract','Email'),
            'remark'=>Yii::t('contract','Remark'),
            'price1'=>Yii::t('contract','Wages Name'),
            'price3'=>Yii::t('contract','Wages Type'),
            'image_user'=>Yii::t('contract','Staff photo'),
            'image_code'=>Yii::t('contract','Id photo'),
            'image_work'=>Yii::t('contract','Work photo'),
            'image_other'=>Yii::t('contract','Other photo'),
            'ld_card'=>Yii::t('contract','Labor security card'),
            'sb_card'=>Yii::t('contract','Social security card'),
            'jj_card'=>Yii::t('contract','Accumulation fund card'),
            'ject_remark'=>Yii::t('contract','Rejected Remark'),
            'update_remark'=>Yii::t('contract',"Operation")."".Yii::t('contract','Remark'),
            'staff_type'=>Yii::t('staff','Staff Type'),
            'staff_leader'=>Yii::t('staff','Team/Group Leader'),
            'test_length'=>Yii::t('contract','Probation Time Longer'),
            'attachment'=>Yii::t('contract','Attachment'),
            'nation'=>Yii::t('contract','nation'),
            'household'=>Yii::t('contract','Household type'),
            'empoyment_code'=>Yii::t('contract','Employment registration certificate'),
            'social_code'=>Yii::t('contract','Social security card number'),
            'fix_time'=>Yii::t('contract','contract deadline'),
            'opr_type'=>Yii::t('contract','Operation Type'),
            'leave_reason'=>Yii::t('contract','Leave Reason'),
            'leave_time'=>Yii::t('contract','Leave Time'),
            'user_card_date'=>Yii::t('contract','ID Card Date'),
            'emergency_user'=>Yii::t('contract','Emergency User'),
            'emergency_phone'=>Yii::t('contract','Emergency Phone'),
            'change_city'=>Yii::t('contract','Change City'),
            'change_city_old'=>Yii::t('contract','Staff City'),
            'code_old'=>Yii::t('contract','Code Old'),
            'effect_time'=>Yii::t('contract','Effect Time'),
            'group_type'=>Yii::t('contract','group type'),
            'wechat'=>Yii::t('contract','wechat'),
            'recommend_user'=>Yii::t('contract','recommend user'),
            'urgency_card'=>Yii::t('contract','urgency card'),
            'address_code'=>Yii::t('contract','Old Address').Yii::t('contract','postcode'),
            'contact_address_code'=>Yii::t('contract','Contact Address').Yii::t('contract','postcode'),
		);
	}

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			//array('id, position, leave_reason, remarks, email, staff_type, leader','safe'),
            array('id,group_type,employee_id,ject_remark,operation,update_remark, code, name, staff_id, company_id, contract_id, address, address_code, contact_address, contact_address_code, phone, phone2, user_card, department, position, wage,time,
             start_time, end_time, test_type, test_start_time, sex, test_end_time, test_wage, word_status, city, entry_time, age, birth_time, health,staff_status,
             ld_card, sb_card, jj_card,attachment,nation, household, empoyment_code, social_code, fix_time,change_city,effect_time,
              education, experience, english, technology, other, year_day, email, remark, image_user, image_code, image_work, image_other',
                'safe'),
			array('ject_remark','required',"on"=>"reject"),
		);
	}

    //獲取可用公司
    public function getCompanyToCity(){
	    $arr = array(""=>"");
        $city = Yii::app()->user->city();
        $rows = Yii::app()->db->createCommand()->select()->from("hr_company")
            ->where('city=:city ', array(':city'=>$city))->queryAll();
        if(count($rows)>0){
            foreach ($rows as $row){
                $arr[$row["id"]] = $row["name"];
            }
        }
        return $arr;
    }
    //自動變化表頭
    public function setFormTitle(){
        return Yii::t("app","Employee Update Audit");
    }
    //獲取可用合同
    public function getContractToCity(){
	    $arr = array(""=>"");
        $city = Yii::app()->user->city();
        $rows = Yii::app()->db->createCommand()->select()->from("hr_contract")
            ->where('city=:city ', array(':city'=>$city))->queryAll();
        if(count($rows)>0){
            foreach ($rows as $row){
                $arr[$row["id"]] = $row["name"];
            }
        }
        return $arr;
    }

    //獲取員工歷史
    public function getStaffHistoryList($staff_id){
        $rows = Yii::app()->db->createCommand()->select()->from("hr_employee_history")
            ->where('employee_id=:id', array(':id'=>$staff_id))->order('id desc')->queryAll();
        $staff = Yii::app()->db->createCommand()->select("code,name")->from("hr_employee")
            ->where('id=:id', array(':id'=>$staff_id))->queryAll();
        if ($rows){
            foreach ($rows as $key => $row){
                if($staff){
                    $rows[$key]["code"] = $staff[0]["code"];
                    $rows[$key]["name"] = $staff[0]["name"];
                }else{
                    $rows[$key]["code"] = "";
                    $rows[$key]["name"] = "";
                }
            }
        }else{
            return "";
        }
        return $rows;
    }

	public function retrieveData($index)
	{
        $suffix = Yii::app()->params['envSuffix'];
        $city = Yii::app()->user->city();
        $rows = Yii::app()->db->createCommand()->select("*,docman$suffix.countdoc('EMPLOYEE',id) as employeedoc")->from("hr_employee_operate")
            ->where('id=:id and finish != 1', array(':id'=>$index))->queryAll();
		if (count($rows) > 0)
		{
			foreach ($rows as $row)
			{
                $this->no_of_attm['employee'] = $row['employeedoc'];
                $this->id = $row['id'];
                $this->employee_id = $row['employee_id'];
                $this->update_remark = $row['update_remark'];
                $this->code = $row['code'];
                $this->name = $row['name'];
                $this->sex = $row['sex'];
                $this->staff_id = $row['staff_id'];
                $this->company_id = $row['company_id'];
                $this->contract_id = $row['contract_id'];
                $this->address = $row['address'];
                $this->contact_address = $row['contact_address'];
                $this->phone = $row['phone'];
                $this->city = $row['city'];
                $this->user_card = $row['user_card'];
                $this->department = $row['department'];
                $this->position = $row['position'];
                $this->wage = $row['wage'];
                $this->start_time = $row['start_time'];
                $this->end_time = $row['end_time'];
                $this->test_type = $row['test_type'];
                $this->test_end_time = empty($row['test_type'])?"":$row['test_end_time'];
                $this->test_start_time = empty($row['test_type'])?"":$row['test_start_time'];
                $this->test_wage = empty($row['test_type'])?"":$row['test_wage'];
                $this->word_status = $row['word_status'];
                $this->address_code = $row['address_code'];
                $this->contact_address_code = $row['contact_address_code'];
                $this->phone2 = $row['phone2'];
                $this->entry_time = $row['entry_time'];
                $this->birth_time = $row['birth_time'];
                $this->age = $row['age'];
                $this->health = $row['health'];
                $this->education = $row['education'];
                $this->staff_status = $row['staff_status'];
                $this->experience = $row['experience'];
                $this->english = $row['english'];
                $this->technology = $row['technology'];
                $this->other = $row['other'];
                $this->year_day = $row['year_day'];
                $this->email = $row['email'];
                $this->remark = $row['remark'];
                $this->ject_remark = $row['ject_remark'];
/*                $this->price1 = $row['price1'];
                $this->price3 = explode(",",$row['price3']);*/
                $this->image_user = $row['image_user'];
                $this->image_code = $row['image_code'];
                $this->image_work = $row['image_work'];
                $this->image_other = $row['image_other'];
                $this->ld_card = $row['ld_card'];
                $this->sb_card = $row['sb_card'];
                $this->jj_card = $row['jj_card'];
                $this->operation = $row['operation'];
                $this->historyList = AuditHistoryForm::getStaffHistoryList($row["employee_id"]);
                $this->test_length = empty($row['test_type'])?"":$row['test_length'];
                $this->staff_type = $row['staff_type'];
                $this->staff_leader = $row['staff_leader'];
                $this->attachment = $row['attachment'];
                $this->nation = $row['nation'];
                $this->household = $row['household'];
                $this->empoyment_code = $row['empoyment_code'];
                $this->social_code = $row['social_code'];
                $this->fix_time = $row['fix_time'];
                $this->opr_type = $row['opr_type'];
                $this->leave_reason = $row['leave_reason'];
                $this->leave_time = $row['leave_time'];
                $this->user_card_date = $row['user_card_date'];
                $this->emergency_user = $row['emergency_user'];
                $this->emergency_phone = $row['emergency_phone'];
                $this->change_city = $row['change_city'];
                $this->code_old = $row['code_old'];
                $this->group_type = $row['group_type'];
                $this->effect_time = $row['effect_time'];
                $this->wechat = $row['wechat'];
                $this->recommend_user = key_exists("recommend_user",$row)?$row['recommend_user']:"";
                $this->urgency_card = $row['urgency_card'];
				break;
			}
		}
		return true;
	}

	public function saveData()
	{
        $uid = Yii::app()->user->id;
        $lud = date("Y-m-d H:i:s");
        $city = Yii::app()->user->city();
        switch ($this->scenario){
            case "audit"://通過
                Yii::app()->db->createCommand()->update('hr_employee_operate', array(
                    'staff_status'=>4,
                    'city'=>$this->change_city,
                    'luu'=>$uid,
                    'lud'=>$lud,
                ), 'id=:id', array(':id'=>$this->id));
                break;
            case "reject"://拒絕
                Yii::app()->db->createCommand()->update('hr_employee_operate', array(
                    'staff_status'=>3,
                    'ject_remark'=>$this->ject_remark,
                    'luu'=>$uid,
                    'lud'=>$lud,
                ), 'id=:id', array(':id'=>$this->id));
                break;
        }
        if($this->scenario == "audit"){
            $this->finish();
            $this->resetEmployeeStatusAndIndex();
        }

        //記錄
        Yii::app()->db->createCommand()->insert('hr_employee_history', array(
            "employee_id"=>$this->employee_id,
            "status"=>$this->scenario,
            "remark"=>$this->ject_remark,
            "lcu"=>$uid,
            "lcd"=>$lud,
        ));
        //發送郵件
        $this->sendEmail();
	}

    private function signContract($staffNew,$city_allow=0){
        $signedContractType = Yii::app()->db->createCommand()->select("set_value")->from("hr_setting")
            ->where("set_name='signedContractType' and set_city in ($city_allow)")->order("set_value asc")->queryScalar();
        if(empty($signedContractType)&&$this->opr_type == "contract"){
            $sign_type = 1;//續約
            $row = Yii::app()->db->createCommand()->select("retire")->from("hr_contract")
                ->where("id=:id",array(":id"=>$staffNew["contract_id"]))->queryRow();
            if($row){
                $sign_type = $row["retire"] == 1?2:1;
            }
            Yii::app()->db->createCommand()->update('hr_sign_contract', array(
                'history_id'=>$this->id
            ), 'employee_id=:id and history_id=0', array(':id'=>$this->employee_id));
            Yii::app()->db->createCommand()->insert('hr_sign_contract',array(
                'employee_id'=>$this->employee_id,
                'status_type'=>0,
                'history_id'=>0,
                'sign_type'=>$sign_type,
                'lcu'=>Yii::app()->user->id,
            ));
        }
    }


    private function sendEmail(){
        $row = Yii::app()->db->createCommand()->select("*")->from("hr_employee_operate")
            ->where("id=:id",array(":id"=>$this->id))->queryRow();
        if($row){
            if ($this->getScenario() == "audit"){
                $description="员工变更审核 - ".$row["name"]."（通过）";
                $subject="员工变更审核 - ".$row["name"]."（通过）";
            }else{
                $description="员工变更审核 - ".$row["name"]."（拒绝）";
                $subject="员工变更审核 - ".$row["name"]."（拒绝）";
            }
            $message="<p>员工编号：".$row["code"]."</p>";
            $message.="<p>员工姓名：".$row["name"]."</p>";
            $message.="<p>员工所在城市：".CGeneral::getCityName($row["city"])."</p>";
            $message.="<p>员工职位：".DeptForm::getDeptToId($row["position"])."</p>";
            $message.="<p>操作原因：".Yii::t("contract",$row["operation"])."</p>";
            $message.="<p>审核日期：".date('Y-m-d H:i:s')."</p>";
            if ($this->getScenario() == "reject"){
                $message.="<p>拒绝原因：".$this->ject_remark."</p>";
            }
            $email = new Email($subject,$message,$description);
            $email->addEmailToLcu($row["lcu"]);
            $email->sent();
        }
    }

    public function setAttachment(){
        $str = $this->attachment;
        if(empty($str)){
            $arr = array();
        }else{
            $arr = explode(",",$str);
            for($i = 0;$i<count($arr);$i++){
                $rows = Yii::app()->db->createCommand()->select()->from("hr_attachment")
                    ->where('id=:id', array(':id'=>$arr[$i]))->queryRow();
                if($rows){
                    $arr[$i] = $rows;
                }else{
                    unset($arr[$i]);
                }
            }
        }
        $this->attachment = $arr;
        return $arr;
    }

    //變更完成
    public function finish(){
        $uid = Yii::app()->user->id;
        $date = date("Y-m-d H:i:s");
        $city_allow = array();
        $staff = Yii::app()->db->createCommand()->select()->from("hr_employee")
            ->where('id=:id', array(':id'=>$this->employee_id))->queryRow();
        $staffNew = Yii::app()->db->createCommand()->select()->from("hr_employee_operate")
            ->where('id=:id', array(':id'=>$this->id))->queryRow();
        $staffNew["code"] = $staff["code"];//不允許變更員工編號
        $city_allow[] = '"'.$staff["city"].'"';
        $city_allow[] = '"'.$staffNew["city"].'"';
        $this->opr_type = $staffNew["opr_type"];
        unset($staff["id"]);
        unset($staff["lcd"]);
        unset($staff["lud"]);
        unset($staff["luu"]);
        unset($staff["lcu"]);
        $keyList =array_keys($staff);
        $operation = $staffNew['operation'];
        $dateKey = array("test_start_time","test_end_time","entry_time","birth_time");
        foreach ($staffNew as $key =>$value){
            if (!in_array($key,$keyList)){
                unset($staffNew[$key]);
                continue;
            }
            if(empty($value)&&in_array($key,$dateKey)){
                unset($staffNew[$key]);
            }
        }
        if($operation === "departure"){
            $staffNew["staff_status"] = -1;//離職
        }else{
            $staffNew["staff_status"] = 0;
        }
        $staff["finish"] = 1;
        Yii::app()->db->createCommand()->update('hr_employee', $staffNew, 'id=:id', array(':id'=>$this->employee_id));
        Yii::app()->db->createCommand()->update('hr_employee_operate', $staff, 'id=:id', array(':id'=>$this->id));

        //修改流程的記錄的時間
        Yii::app()->db->createCommand()->update('hr_employee_history', array('lud'=>$date), 'history_id=:id',array(":id"=>$this->id));
        //交換員工附件
        $this->replaceAttachment();

        //判斷是否需要生成簽署合同
        $this->signContract($staffNew,implode(",",$city_allow));

        //員工姓名變更後需要修改其它數據表
        $this->resetOtherTable($staff,$staffNew);

        //員工離職後需要隨機修改登錄賬號的密碼
        $this->updateUserPassword($staffNew);
    }

    //員工離職後需要隨機修改登錄賬號的密碼
    private function updateUserPassword($staffNew){
        if($staffNew["staff_status"]==-1){//員工離職
            $password = date("YmdHis")."_".$this->employee_id;
            $suffix = Yii::app()->params['envSuffix'];
            $row = Yii::app()->db->createCommand()->select("user_id")->from("hr_binding")
                ->where('employee_id=:id', array(':id'=>$this->employee_id))->queryRow();
            if($row){//如果該員工綁定了登錄賬戶
                Yii::app()->db->createCommand()->update("security$suffix.sec_user",array(
                    "password"=>$password
                ),"username=:username",array(":username"=>$row["user_id"]));
            }
        }
    }

    //強制刷新員工姓名(歷史id)
    public static function resetOnlyHistory($history_id){
        $staff = Yii::app()->db->createCommand()->select("employee_id as id,code,name")->from("hr_employee_operate")
            ->where('id=:id', array(':id'=>$history_id))->queryRow();
        if($staff){
            $staffNew = Yii::app()->db->createCommand()->select("code,name")->from("hr_employee")
                ->where('id=:id', array(':id'=>$staff["id"]))->queryRow();
            if($staffNew){
                self::resetOtherTable($staff,$staffNew,true);
                echo "success";
            }else{
                echo "employee_id error";
            }
        }else{
            echo "history_id error";
        }
    }

    //員工姓名變更後需要修改其它數據表
    private function resetOtherTable($staff,$staffNew,$echoBool=false){
        $staffCode = $staff["code"];//員工code
        $oldName = $staff["name"];//員工舊名字
        $oldCodeName = $staff["name"]." (".$staff["code"].")";
        $newName = $staffNew["name"];
        $newCodeName = $staffNew["name"]." (".$staffNew["code"].")";
        $suffix = Yii::app()->params['envSuffix'];
        if($oldName!=$newName){
            $list = array(
                array("table"=>"swoper$suffix.swo_service","updateData"=>array("salesman"=>$newCodeName),"whereSql"=>"salesman='$oldCodeName'"),
                array("table"=>"swoper$suffix.swo_service","updateData"=>array("othersalesman"=>$newCodeName),"whereSql"=>"othersalesman='$oldCodeName'"),
                array("table"=>"swoper$suffix.swo_service","updateData"=>array("technician"=>$newCodeName),"whereSql"=>"technician='$oldCodeName'"),
                array("table"=>"swoper$suffix.swo_service","updateData"=>array("first_tech"=>$newCodeName),"whereSql"=>"first_tech='$oldCodeName'"),
                array("table"=>"swoper$suffix.swo_followup","updateData"=>array("resp_staff"=>$newCodeName),"whereSql"=>"resp_staff='$oldCodeName'"),
                array("table"=>"swoper$suffix.swo_followup","updateData"=>array("resp_tech"=>$newCodeName),"whereSql"=>"resp_tech='$oldCodeName'"),
                array("table"=>"swoper$suffix.swo_followup","updateData"=>array("follow_tech"=>$newCodeName),"whereSql"=>"follow_tech='$oldCodeName'"),
                array("table"=>"swoper$suffix.swo_followup","updateData"=>array("follow_staff"=>$newCodeName),"whereSql"=>"follow_staff='$oldCodeName'"),
                array("table"=>"swoper$suffix.swo_enquiry","updateData"=>array("follow_staff"=>$newCodeName),"whereSql"=>"follow_staff='$oldCodeName'"),
                array("table"=>"swoper$suffix.swo_enquiry","updateData"=>array("record_by"=>$newCodeName),"whereSql"=>"record_by='$oldCodeName'"),
                array("table"=>"swoper$suffix.swo_logistic","updateData"=>array("salesman"=>$newCodeName),"whereSql"=>"salesman='$oldCodeName'"),
                array("table"=>"swoper$suffix.swo_logistic","updateData"=>array("follow_staff"=>$newCodeName),"whereSql"=>"follow_staff='$oldCodeName'"),
                array("table"=>"swoper$suffix.swo_qc","updateData"=>array("job_staff"=>" ".$newCodeName),"whereSql"=>"job_staff=' $oldCodeName'"),
                array("table"=>"swoper$suffix.swo_qc","updateData"=>array("qc_staff"=>" ".$newCodeName),"whereSql"=>"qc_staff=' $oldCodeName'"),
                array("table"=>"account$suffix.acc_service_comm_copy","updateData"=>array("salesman"=>$newCodeName),"whereSql"=>"salesman='$oldCodeName'"),
                array("table"=>"account$suffix.acc_service_comm_copy","updateData"=>array("othersalesman"=>$newCodeName),"whereSql"=>"othersalesman='$oldCodeName'"),
                array("table"=>"account$suffix.acc_service_comm_copy","updateData"=>array("technician"=>$newCodeName),"whereSql"=>"technician='$oldCodeName'"),
                array("table"=>"account$suffix.acc_service_comm_copy","updateData"=>array("first_tech"=>$newCodeName),"whereSql"=>"first_tech='$oldCodeName'"),
                array("table"=>"account$suffix.acc_service_comm_hdr","updateData"=>array("employee_name"=>$newName),"whereSql"=>"employee_code='$staffCode'"),
                array("table"=>"account$suffix.acc_request","updateData"=>array("payee_name"=>$newCodeName),"whereSql"=>"payee_name='$oldCodeName'"),
                array("table"=>"account$suffix.acc_trans_info","updateData"=>array("field_value"=>$newCodeName),"whereSql"=>"field_id='payer_name' and field_value='$oldCodeName'"),
                array("table"=>"account$suffix.acc_trans_info","updateData"=>array("field_value"=>$newCodeName),"whereSql"=>"field_id='handle_staff_name' and field_value='$oldCodeName'"),
                array("table"=>"sales$suffix.sal_search","updateData"=>array("employee_name"=>$newName),"whereSql"=>"employee_code='$staffCode'"),
            );
            foreach ($list as $row){
                $number = Yii::app()->db->createCommand()->update($row["table"],$row["updateData"],$row["whereSql"]);
                if($echoBool){
                    $table = end(explode(".",$row["table"]));
                    echo $table." update Num:".$number."<br/>";
                }
            }
        }
    }

    //交換員工附件
    public function replaceAttachment(){
        $connection = Yii::app()->db;
        $suffix = Yii::app()->params['envSuffix'];
        $attachment_old = $connection->createCommand()->select("id,doc_type_code,doc_id,remove")->from("docman$suffix.dm_master")
            ->where('doc_id=:doc_id and doc_type_code=:doc_type_code', array(
                ':doc_id'=>$this->employee_id,
                ':doc_type_code'=>"EMPLOY"
            ))->queryRow();
        $attachment_now = $connection->createCommand()->select("id,doc_type_code,doc_id,remove")->from("docman$suffix.dm_master")
            ->where('doc_id=:doc_id and doc_type_code=:doc_type_code', array(
                ':doc_id'=>$this->id,
                ':doc_type_code'=>"EMPLOYEE"
            ))->queryRow();

        if($attachment_old&&$attachment_now){
            //都有附件
            $old_id =$attachment_old["id"];
            $now_id =$attachment_now["id"];
            unset($attachment_old["id"]);
            unset($attachment_now["id"]);
            $connection->createCommand()->update("docman$suffix.dm_master",$attachment_old,'id=:id', array(':id'=>$now_id));
            $connection->createCommand()->update("docman$suffix.dm_master",$attachment_now,'id=:id', array(':id'=>$old_id));
        }elseif($attachment_old){
            //有旧没有新
            $old_id =$attachment_old["id"];
            unset($attachment_old["id"]);
            $attachment_now["doc_type_code"]="EMPLOYEE";
            $attachment_now["doc_id"]=$this->id;
            $connection->createCommand()->update("docman$suffix.dm_master",$attachment_now,'id=:id', array(':id'=>$old_id));
        }elseif ($attachment_now){
            //有新没有旧
            $now_id =$attachment_now["id"];
            unset($attachment_now["id"]);
            $attachment_now["doc_type_code"]="EMPLOY";
            $attachment_now["doc_id"]=$this->employee_id;
            $connection->createCommand()->update("docman$suffix.dm_master",$attachment_now,'id=:id', array(':id'=>$now_id));
        }
    }

    //刷新员工的状态及排序
    private function resetEmployeeStatusAndIndex(){
        $firstday = date("Y/m/d");
        $lastday = date("Y/m/d",strtotime("$firstday + 1 month"));
        $command = Yii::app()->db->createCommand();
        $aaa = $command->update('hr_employee', array("z_index"=>2),"staff_status=0 and test_type=1 and replace(test_start_time,'-', '/') <= '$firstday' and replace(test_end_time,'-', '/') >='$firstday'");//試用期
        $command->reset();
        //echo "試用期:$aaa<br>";
        $aaa = $command->update('hr_employee', array("z_index"=>1),"staff_status=0 and test_type=1 and replace(test_start_time,'-', '/') >= '$firstday'");//未入職
        $command->reset();
        //echo "未入職:$aaa<br>";
        $aaa = $command->update('hr_employee', array("z_index"=>5),"staff_status=0 and (test_type=0 or replace(test_end_time,'-', '/') <='$firstday')");//正式員工
        $command->reset();
        //echo "正式員工:$aaa<br>";
        $aaa = $command->update('hr_employee', array("z_index"=>4),"staff_status=0 and fix_time='fixation' and replace(end_time,'-', '/') >='$firstday' and replace(end_time,'-', '/') <='$lastday'");//合同即將過期
        $command->reset();
        //echo "合同即將過期:$aaa<br>";
        $aaa = $command->update('hr_employee', array("z_index"=>3),"staff_status=0 and fix_time='fixation' and replace(end_time,'-', '/') <'$firstday'");//合同過期
        //echo "合同過期:$aaa<br>";

        if (!isset(Yii::app()->params['retire']) || Yii::app()->params['retire']==true) {
            //echo "員工退休年齡(男60 女50):$aaa<br>";
            $row = Yii::app()->db->createCommand()->select("set_value")->from("hr_setting")
                ->where('set_name="retirementAgeType"')->queryScalar();
            switch ($row){
                case 1://新加坡-62岁
                    $manDate = date("Y/m/d", strtotime("-62 year"));
                    $womanDate = date("Y/m/d", strtotime("-62 year"));
                    break;
                case 2://吉隆坡-60岁
                    $manDate = date("Y/m/d", strtotime("-60 year"));
                    $womanDate = date("Y/m/d", strtotime("-60 year"));
                    break;
                default://echo "員工退休年齡(男60 女50):$aaa<br>";
                    $manDate = date("Y/m/d", strtotime("-60 year"));
                    $womanDate = date("Y/m/d", strtotime("-50 year"));
            }
            $sql = "UPDATE hr_employee a LEFT JOIN hr_contract b ON a.contract_id = b.id SET a.z_index = 0 WHERE ";
            $sql .= "a.birth_time is not null and a.birth_time != '' and a.staff_status=0 and b.retire=0 and ((replace(a.birth_time,'-', '/') <='$womanDate' and a.sex='woman') or (replace(a.birth_time,'-', '/') <='$manDate' and a.sex='man'))";
            $aa = Yii::app()->db->createCommand($sql)->execute();//要退休的員工前排顯示
        }
    }
}
