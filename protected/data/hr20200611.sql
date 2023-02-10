-- MySQL dump 10.13  Distrib 5.7.30, for Linux (x86_64)
--
-- Host: localhost    Database: hr
-- ------------------------------------------------------
-- Server version	5.7.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `hr_agreement`
--

DROP TABLE IF EXISTS `hr_agreement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_agreement` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `docx_url` varchar(300) NOT NULL,
  `type` int(30) NOT NULL DEFAULT '0' COMMENT '是否启用',
  `city` varchar(30) DEFAULT NULL,
  `lcu` varchar(30) DEFAULT NULL,
  `luu` varchar(30) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='合同文檔';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_apply_support`
--

DROP TABLE IF EXISTS `hr_apply_support`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_apply_support` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `support_code` varchar(255) DEFAULT NULL,
  `service_type` int(11) NOT NULL DEFAULT '1' COMMENT '服務類型 1：服务支援 2：技術支援',
  `apply_date` date NOT NULL COMMENT '申請時間',
  `apply_num` int(11) NOT NULL DEFAULT '1' COMMENT '申請人數（暫定字段，不使用）',
  `apply_type` int(11) NOT NULL DEFAULT '1' COMMENT '申请类型： 1（新申请） 2（续期）',
  `privilege` int(2) NOT NULL DEFAULT '0' COMMENT '0:不使用特權  1：人員置換  2：優先權',
  `privilege_user` int(2) DEFAULT NULL COMMENT '人員置換的員工id',
  `apply_end_date` date NOT NULL COMMENT '結束時間',
  `apply_length` int(11) NOT NULL DEFAULT '1' COMMENT '申請總時間',
  `apply_remark` text COMMENT '申請備註',
  `length_type` int(11) NOT NULL DEFAULT '1' COMMENT '時間類型  1：月  2：天',
  `apply_city` varchar(255) NOT NULL COMMENT '申請支援的城市',
  `apply_lcu` varchar(255) NOT NULL COMMENT '申請人',
  `update_type` int(11) NOT NULL DEFAULT '0' COMMENT '0:无修改  1：修改申请时间',
  `update_remark` text COMMENT '修改備註',
  `employee_id` int(11) DEFAULT NULL COMMENT '支援过去的员工id',
  `audit_remark` text COMMENT '審核備註',
  `tem_s_ist` text COMMENT '評核項目列表(json)',
  `tem_str` text,
  `tem_sum` int(11) DEFAULT NULL COMMENT '項目總分（需要乘10）',
  `review_sum` float(10,2) DEFAULT NULL COMMENT '評核總分',
  `status_type` int(11) NOT NULL DEFAULT '1' COMMENT '1:草稿  2:申請中  3:已查看 4:排隊等候 5:待評分 6:已評分 7:已完成 8:拒绝提前結束 9:申請提前結束 10:申請续期 11:拒绝续期',
  `change_num` float(3,2) NOT NULL DEFAULT '0.00' COMMENT '請假天數',
  `early_date` date DEFAULT NULL COMMENT '提前結束/續期時間',
  `early_remark` text COMMENT '提前結束/續期備註',
  `reject_remark` text COMMENT '拒绝備註',
  `lcu` varchar(255) DEFAULT NULL,
  `luu` varchar(255) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='中央技术支援申请';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_apply_support_history`
--

DROP TABLE IF EXISTS `hr_apply_support_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_apply_support_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `support_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `apply_length` int(11) NOT NULL DEFAULT '1' COMMENT '申請總時間',
  `length_type` int(11) NOT NULL DEFAULT '1' COMMENT '時間類型  1：月  2：天',
  `status_type` int(255) NOT NULL DEFAULT '2' COMMENT '同步申請支援的狀態',
  `status_remark` text,
  `lcu` varchar(255) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='中央支援记录表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_assess`
--

DROP TABLE IF EXISTS `hr_assess`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_assess` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `work_type` varchar(255) DEFAULT NULL COMMENT '工种',
  `service_effect` varchar(255) DEFAULT NULL COMMENT '服務效果',
  `service_process` varchar(255) DEFAULT NULL COMMENT '服务流程',
  `carefully` varchar(255) DEFAULT NULL COMMENT '細心度',
  `judge` varchar(255) DEFAULT NULL COMMENT '判斷力',
  `deal` varchar(255) DEFAULT NULL COMMENT '處理能力',
  `connects` varchar(255) DEFAULT NULL COMMENT '溝通能力',
  `obey` varchar(255) DEFAULT NULL COMMENT '服從度',
  `leadership` varchar(255) DEFAULT NULL COMMENT '領導力',
  `characters` text COMMENT '性格',
  `assess` text COMMENT '評估',
  `email_bool` int(2) DEFAULT '0' COMMENT '是否已經發送郵件0：無 1：有',
  `email_list` text,
  `staff_type` varchar(255) DEFAULT '3' COMMENT '工種',
  `overall_effect` varchar(255) DEFAULT NULL COMMENT '整體效果',
  `lcu` varchar(255) DEFAULT NULL,
  `luu` varchar(255) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='員工評估表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_attachment`
--

DROP TABLE IF EXISTS `hr_attachment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_attachment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `path_url` varchar(255) NOT NULL COMMENT '附件地址',
  `file_name` varchar(255) NOT NULL COMMENT '附件名字',
  `lcu` varchar(255) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='員工的附件表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_audit_con`
--

DROP TABLE IF EXISTS `hr_audit_con`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_audit_con` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city` varchar(100) NOT NULL,
  `audit_index` int(3) NOT NULL DEFAULT '3' COMMENT '1:一層  2：二層  3：三層',
  `lcu` varchar(100) DEFAULT NULL,
  `luu` varchar(100) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='加班、請假審核配置表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_binding`
--

DROP TABLE IF EXISTS `hr_binding`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_binding` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(10) unsigned NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `lcu` varchar(255) DEFAULT NULL,
  `luu` varchar(255) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_binding_01` (`employee_id`),
  KEY `idx_binding_02` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=328 DEFAULT CHARSET=utf8 COMMENT='......';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_city`
--

DROP TABLE IF EXISTS `hr_city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(20) NOT NULL,
  `z_index` int(2) NOT NULL DEFAULT '1' COMMENT '1:專業組  2：初階組',
  `lcu` varchar(255) DEFAULT NULL,
  `luu` varchar(255) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='城市等級表（錦旗\n專用）';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_company`
--

DROP TABLE IF EXISTS `hr_company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_company` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '公司名字',
  `agent` varchar(30) NOT NULL COMMENT '代理人',
  `agent_address` varchar(200) DEFAULT NULL COMMENT '委托代理人地址',
  `agent_email` varchar(100) DEFAULT NULL,
  `head` varchar(30) NOT NULL COMMENT '負責人',
  `head_email` varchar(100) DEFAULT NULL,
  `legal` varchar(30) DEFAULT NULL COMMENT '法定負責人',
  `legal_email` varchar(100) DEFAULT NULL,
  `legal_city` varchar(100) DEFAULT NULL COMMENT '法人章所在城市',
  `address` varchar(255) NOT NULL COMMENT '公司地址',
  `postal` varchar(100) DEFAULT NULL COMMENT '郵政編碼',
  `address2` varchar(255) DEFAULT NULL,
  `postal2` varchar(255) DEFAULT NULL,
  `city` varchar(30) NOT NULL COMMENT '公司歸屬地區',
  `phone` varchar(255) DEFAULT NULL COMMENT '公司電話',
  `phone_two` varchar(100) DEFAULT NULL,
  `tacitly` varchar(11) DEFAULT '0' COMMENT '默認公司：0（否）1（是）',
  `organization_code` varchar(30) DEFAULT NULL COMMENT '組織機構代碼',
  `organization_time` varchar(60) DEFAULT NULL COMMENT '組織機構代碼發出時間',
  `security_code` varchar(30) DEFAULT NULL COMMENT '勞動保障代碼',
  `license_code` varchar(30) DEFAULT NULL COMMENT '證照編號',
  `license_time` varchar(60) DEFAULT NULL COMMENT '證照發出日期',
  `mie` varchar(10) DEFAULT NULL COMMENT '滅蟲執照級別',
  `taxpayer_num` varchar(100) DEFAULT NULL,
  `lcu` varchar(30) DEFAULT NULL,
  `luu` varchar(30) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='公司資料表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_contract`
--

DROP TABLE IF EXISTS `hr_contract`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_contract` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `city` varchar(30) NOT NULL,
  `retire` int(2) NOT NULL DEFAULT '0' COMMENT '0:非退休合同  1：退休合同',
  `lcu` varchar(30) DEFAULT NULL,
  `luu` varchar(30) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='...';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_contract_docx`
--

DROP TABLE IF EXISTS `hr_contract_docx`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_contract_docx` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contract_id` int(10) NOT NULL,
  `docx` int(10) NOT NULL,
  `index` int(10) DEFAULT NULL COMMENT '層級',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='合同與文檔的關連表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_dept`
--

DROP TABLE IF EXISTS `hr_dept`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_dept` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `z_index` varchar(11) DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '0:部門  1:職位',
  `city` varchar(255) DEFAULT NULL,
  `dept_id` int(11) DEFAULT '1' COMMENT '部門id',
  `dept_class` varchar(50) DEFAULT NULL COMMENT '職位類別',
  `sales_type` int(2) NOT NULL DEFAULT '0' COMMENT '是否是銷售部門 0:不是 1:是',
  `manager` int(2) NOT NULL DEFAULT '0' COMMENT '0:不是經理  1：是經理',
  `technician` int(2) NOT NULL DEFAULT '0' COMMENT '0:不是技術員   1：技術員',
  `review_status` int(2) NOT NULL DEFAULT '0' COMMENT '是否參與評分高低差異 0:不參與 1:參與',
  `review_type` int(2) NOT NULL DEFAULT '1' COMMENT '评核类型 1:正常 2:技术员 3:銷售 4:地區主管',
  `review_leave` int(2) NOT NULL DEFAULT '0' COMMENT '評核級別 0:無 1:地區 2：所有',
  `manager_type` int(2) NOT NULL DEFAULT '0' COMMENT '銷售的經理判斷 0:無 1:員工 2：副經理 3：經理',
  `lcu` varchar(50) DEFAULT NULL,
  `luu` varchar(50) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=166 DEFAULT CHARSET=utf8 COMMENT='工作部門';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_docx`
--

DROP TABLE IF EXISTS `hr_docx`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_docx` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `docx_url` varchar(300) NOT NULL,
  `type` varchar(30) NOT NULL COMMENT '文檔可見類型（local：本地可見，default：全球可見）',
  `city` varchar(30) DEFAULT NULL,
  `lcu` varchar(30) DEFAULT NULL,
  `luu` varchar(30) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='合同文檔';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_down_form`
--

DROP TABLE IF EXISTS `hr_down_form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_down_form` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `docx_url` varchar(300) NOT NULL,
  `remark` text COMMENT '文檔說明',
  `city` varchar(30) DEFAULT NULL,
  `lcu` varchar(30) DEFAULT NULL,
  `luu` varchar(30) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='合同文檔';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_email`
--

DROP TABLE IF EXISTS `hr_email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_email` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject` text NOT NULL COMMENT '邮件主題',
  `message` text NOT NULL COMMENT '郵件內容',
  `request_dt` datetime DEFAULT NULL COMMENT '郵件發送時間',
  `city_id` text COMMENT '收到郵件的城市',
  `city_str` text COMMENT '收到郵件的城市',
  `city` varchar(100) NOT NULL COMMENT '歸屬城市',
  `staff_id` text COMMENT '額外收件人',
  `staff_str` text,
  `status_type` int(2) DEFAULT '4',
  `lcu` varchar(100) DEFAULT NULL,
  `luu` varchar(100) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='郵件提醒列表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_employee`
--

DROP TABLE IF EXISTS `hr_employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_employee` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `code` varchar(20) DEFAULT NULL COMMENT '員工編號',
  `sex` varchar(10) DEFAULT NULL,
  `city` varchar(20) NOT NULL,
  `staff_id` varchar(10) DEFAULT NULL,
  `group_type` int(2) NOT NULL DEFAULT '0' COMMENT '組別分類 0:無 1:商業組 2：餐飲組',
  `company_id` int(100) DEFAULT NULL,
  `contract_id` int(100) DEFAULT NULL,
  `user_card` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `address_code` varchar(10) DEFAULT NULL COMMENT '郵政編碼',
  `contact_address` varchar(255) DEFAULT NULL,
  `contact_address_code` varchar(10) DEFAULT NULL COMMENT '郵政編碼',
  `phone` varchar(50) DEFAULT NULL,
  `phone2` varchar(20) DEFAULT NULL COMMENT '緊急電話',
  `wechat` varchar(50) DEFAULT NULL COMMENT '微信号码',
  `urgency_card` varchar(50) DEFAULT NULL COMMENT '緊急聯繫人身份證',
  `department` varchar(20) DEFAULT NULL,
  `position` varchar(20) DEFAULT NULL,
  `wage` varchar(20) DEFAULT NULL,
  `fix_time` varchar(11) DEFAULT NULL,
  `start_time` date DEFAULT NULL,
  `end_time` varchar(50) DEFAULT NULL COMMENT '合同結束時間',
  `test_start_time` varchar(40) DEFAULT NULL COMMENT '試用期開始時間',
  `test_end_time` varchar(40) DEFAULT NULL COMMENT '試用期結束時間',
  `test_wage` varchar(20) DEFAULT NULL COMMENT '試用期工資',
  `test_type` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '試用期類型：0（無試用期）、 1（有試用期）',
  `test_length` varchar(10) DEFAULT NULL,
  `word_status` int(10) NOT NULL DEFAULT '0' COMMENT '是否已經生成合同：0（沒有）、1（有）',
  `word_url` varchar(300) DEFAULT NULL COMMENT '員工合同的地址',
  `staff_old_status` int(11) NOT NULL DEFAULT '1' COMMENT '員工的前一個狀態',
  `staff_status` int(11) NOT NULL DEFAULT '0' COMMENT '員工狀態：0（已經入職）',
  `entry_time` varchar(40) DEFAULT '2017-08-01' COMMENT '入職時間',
  `age` varchar(11) DEFAULT NULL COMMENT '年齡',
  `birth_time` varchar(40) DEFAULT NULL COMMENT '出生日期',
  `ld_card` varchar(40) DEFAULT NULL COMMENT '勞動保障卡號',
  `sb_card` varchar(40) DEFAULT NULL COMMENT '社保卡號',
  `jj_card` varchar(40) DEFAULT NULL COMMENT '公積金卡號',
  `house_type` varchar(20) DEFAULT NULL COMMENT '戶籍類型',
  `health` varchar(100) DEFAULT NULL COMMENT '身體狀態',
  `education` varchar(100) DEFAULT NULL COMMENT '學歷',
  `experience` varchar(100) DEFAULT NULL COMMENT '工作經驗',
  `english` text COMMENT '外語水平',
  `technology` text COMMENT '技術水平',
  `other` text COMMENT '其它',
  `year_day` varchar(11) DEFAULT NULL COMMENT '年假',
  `email` varchar(50) DEFAULT NULL COMMENT '員工郵箱',
  `ject_remark` text COMMENT '拒絕備註',
  `remark` text COMMENT '備註',
  `price1` varchar(20) DEFAULT NULL COMMENT '每月工資',
  `price2` varchar(20) DEFAULT NULL COMMENT '加班工資',
  `price3` varchar(255) DEFAULT NULL COMMENT '每月補貼',
  `image_user` varchar(255) DEFAULT NULL COMMENT '員工照片地址',
  `image_code` varchar(255) DEFAULT NULL COMMENT '員工身份證照片',
  `image_work` varchar(255) DEFAULT NULL COMMENT '工作證明照片',
  `image_other` varchar(255) DEFAULT NULL COMMENT '其它照片',
  `staff_type` varchar(50) DEFAULT NULL,
  `staff_leader` varchar(50) DEFAULT NULL,
  `attachment` text COMMENT '附件',
  `nation` varchar(100) DEFAULT NULL COMMENT '民族',
  `household` varchar(50) DEFAULT NULL COMMENT '户籍类型',
  `empoyment_code` varchar(100) DEFAULT NULL COMMENT '就业登记证号',
  `social_code` varchar(100) DEFAULT NULL COMMENT '社会保障卡号',
  `leave_time` varchar(255) DEFAULT NULL,
  `leave_reason` text,
  `user_card_date` varchar(100) DEFAULT NULL,
  `emergency_user` varchar(255) DEFAULT NULL,
  `emergency_phone` varchar(255) DEFAULT NULL,
  `code_old` varchar(255) DEFAULT NULL,
  `z_index` int(11) NOT NULL DEFAULT '1',
  `signed_bool` int(2) DEFAULT '0' COMMENT '是否發送簽約提示郵件 0：無  1：有',
  `lcu` varchar(20) DEFAULT NULL,
  `luu` varchar(20) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=353 DEFAULT CHARSET=utf8 COMMENT='員工表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_employee_history`
--

DROP TABLE IF EXISTS `hr_employee_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_employee_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(10) unsigned NOT NULL COMMENT '員工id',
  `history_id` varchar(10) DEFAULT NULL COMMENT '歷史id',
  `status` varchar(255) NOT NULL COMMENT '操作',
  `num` varchar(100) DEFAULT NULL COMMENT '續約次數',
  `remark` varchar(255) DEFAULT NULL COMMENT '備註',
  `lcu` varchar(255) NOT NULL COMMENT '操作人',
  `lcd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '操作時間',
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2040 DEFAULT CHARSET=utf8 COMMENT='員工被操作的歷史';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_employee_leave`
--

DROP TABLE IF EXISTS `hr_employee_leave`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_employee_leave` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `leave_code` varchar(255) DEFAULT NULL COMMENT '請假編號',
  `employee_id` varchar(200) NOT NULL COMMENT '員工id',
  `vacation_id` int(10) NOT NULL DEFAULT '0' COMMENT '請假類型的id',
  `leave_cause` text COMMENT '請假原因',
  `start_time` datetime DEFAULT NULL COMMENT '請假開始時間',
  `start_time_lg` varchar(10) DEFAULT 'AM',
  `end_time` datetime DEFAULT NULL COMMENT '請假結束時間',
  `end_time_lg` varchar(10) DEFAULT 'PM',
  `log_time` float(5,1) DEFAULT NULL COMMENT '請假總時長',
  `leave_cost` float(10,2) DEFAULT NULL COMMENT '請假費用',
  `z_index` int(10) DEFAULT '1' COMMENT '審核層級（1:部門審核、2：主管、3：總監>、4：你）',
  `status` int(10) DEFAULT '0' COMMENT '審核的狀態(0:草稿、1：審核、2：審核通過、3：拒絕、4：完成）',
  `user_lcu` varchar(255) DEFAULT NULL,
  `user_lcd` varchar(255) DEFAULT NULL,
  `area_lcu` varchar(255) DEFAULT NULL,
  `area_lcd` varchar(255) DEFAULT NULL,
  `head_lcu` varchar(255) DEFAULT NULL,
  `head_lcd` varchar(255) DEFAULT NULL,
  `you_lcu` varchar(255) DEFAULT NULL,
  `you_lcd` varchar(255) DEFAULT NULL,
  `audit_remark` text,
  `reject_cause` text COMMENT '拒絕原因',
  `auto_cost` int(2) DEFAULT '1' COMMENT '費用是否自動計算（0：否、 1：是）',
  `city` varchar(255) DEFAULT NULL,
  `lcu` varchar(255) DEFAULT NULL,
  `luu` varchar(255) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='員工請假表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_employee_leave_info`
--

DROP TABLE IF EXISTS `hr_employee_leave_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_employee_leave_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `leave_id` int(11) NOT NULL COMMENT '请假單id',
  `start_time` datetime NOT NULL,
  `start_time_lg` varchar(10) NOT NULL DEFAULT 'AM',
  `end_time` datetime NOT NULL,
  `end_time_lg` varchar(10) NOT NULL DEFAULT 'AM',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='員工请假額外擴充的時間表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_employee_operate`
--

DROP TABLE IF EXISTS `hr_employee_operate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_employee_operate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(10) unsigned NOT NULL,
  `name` varchar(30) NOT NULL COMMENT '員工名字',
  `code` varchar(20) DEFAULT NULL COMMENT '員工編號',
  `sex` varchar(10) DEFAULT NULL,
  `city` varchar(20) NOT NULL,
  `staff_id` varchar(10) DEFAULT NULL,
  `group_type` int(2) NOT NULL DEFAULT '0' COMMENT '組別分類 0:無 1:商業組 2：餐飲組',
  `company_id` int(10) unsigned NOT NULL COMMENT '公司id',
  `contract_id` int(10) unsigned NOT NULL COMMENT '合同id',
  `user_card` varchar(50) NOT NULL COMMENT '身份證號碼',
  `address` varchar(255) NOT NULL COMMENT '員工住址',
  `address_code` varchar(10) DEFAULT NULL COMMENT '郵政編碼',
  `contact_address` varchar(255) NOT NULL COMMENT '通訊地址',
  `contact_address_code` varchar(10) DEFAULT NULL COMMENT '郵政編碼',
  `phone` varchar(20) NOT NULL COMMENT '聯繫電話',
  `phone2` varchar(20) DEFAULT NULL COMMENT '緊急電話',
  `wechat` varchar(50) DEFAULT NULL COMMENT '微信号码',
  `urgency_card` varchar(50) DEFAULT NULL COMMENT '緊急聯繫人身份證',
  `department` varchar(20) NOT NULL COMMENT '部門',
  `position` varchar(20) NOT NULL COMMENT '職位',
  `wage` int(20) unsigned NOT NULL COMMENT '工資',
  `fix_time` varchar(10) NOT NULL DEFAULT 'fixation',
  `start_time` date NOT NULL COMMENT '合同開始時間',
  `end_time` varchar(100) DEFAULT NULL COMMENT '合同結束時間',
  `test_start_time` varchar(20) DEFAULT NULL COMMENT '試用期開始時間',
  `test_end_time` varchar(20) DEFAULT NULL COMMENT '試用期結束時間',
  `test_wage` varchar(20) DEFAULT NULL COMMENT '試用期工資',
  `test_type` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '試用期類型：0（無試用期）、 1（有試用期）',
  `test_length` varchar(10) DEFAULT NULL,
  `word_status` int(10) NOT NULL DEFAULT '0' COMMENT '是否已經生成合同：0（沒有）、1（有）',
  `word_url` varchar(300) DEFAULT NULL COMMENT '員工合同的地址',
  `staff_old_status` int(11) NOT NULL DEFAULT '1' COMMENT '員工的前一個狀態',
  `operation` varchar(255) NOT NULL DEFAULT 'update' COMMENT '操作原因',
  `opr_type` varchar(255) DEFAULT NULL COMMENT '合同變更類型',
  `finish` int(10) NOT NULL DEFAULT '0' COMMENT '是否完成。1：是，0：否',
  `staff_status` int(11) NOT NULL DEFAULT '0' COMMENT '員工狀態：0（已經入職）',
  `entry_time` varchar(20) DEFAULT '2017-08-01' COMMENT '入職時間',
  `age` varchar(11) DEFAULT NULL COMMENT '年齡',
  `birth_time` varchar(20) DEFAULT NULL COMMENT '出生日期',
  `ld_card` varchar(40) DEFAULT NULL COMMENT '勞動保障卡號',
  `sb_card` varchar(40) DEFAULT NULL COMMENT '社保卡號',
  `jj_card` varchar(40) DEFAULT NULL COMMENT '公積金卡號',
  `house_type` varchar(20) DEFAULT NULL COMMENT '戶籍類型',
  `health` varchar(100) DEFAULT NULL COMMENT '身體狀態',
  `education` varchar(100) DEFAULT NULL COMMENT '學歷',
  `experience` varchar(100) DEFAULT NULL COMMENT '工作經驗',
  `english` text COMMENT '外語水平',
  `technology` text COMMENT '技術水平',
  `other` text COMMENT '其它',
  `year_day` varchar(11) DEFAULT NULL COMMENT '年假',
  `email` varchar(50) DEFAULT NULL COMMENT '員工郵箱',
  `ject_remark` text COMMENT '拒絕備註',
  `remark` text COMMENT '備註',
  `update_remark` text COMMENT '變更說明',
  `price1` varchar(20) DEFAULT NULL COMMENT '每月工資',
  `price2` varchar(20) DEFAULT NULL COMMENT '加班工資',
  `price3` varchar(255) DEFAULT NULL COMMENT '每月補貼',
  `image_user` varchar(255) DEFAULT NULL COMMENT '員工照片地址',
  `image_code` varchar(255) DEFAULT NULL COMMENT '員工身份證照片',
  `image_work` varchar(255) DEFAULT NULL COMMENT '工作證明照片',
  `image_other` varchar(255) DEFAULT NULL COMMENT '其它照片',
  `staff_type` varchar(50) DEFAULT NULL,
  `staff_leader` varchar(50) DEFAULT NULL,
  `attachment` text COMMENT '附件',
  `nation` varchar(100) DEFAULT NULL COMMENT '民族',
  `household` varchar(50) DEFAULT NULL COMMENT '户籍类型',
  `empoyment_code` varchar(100) DEFAULT NULL COMMENT '就业登记证号',
  `social_code` varchar(100) DEFAULT NULL COMMENT '社会保障卡号',
  `leave_time` varchar(255) DEFAULT NULL,
  `leave_reason` text,
  `user_card_date` varchar(100) DEFAULT NULL,
  `emergency_user` varchar(255) DEFAULT NULL,
  `emergency_phone` varchar(255) DEFAULT NULL,
  `change_city` varchar(255) DEFAULT NULL COMMENT '調職城市',
  `code_old` varchar(255) DEFAULT NULL,
  `z_index` int(11) NOT NULL DEFAULT '1',
  `signed_bool` int(2) DEFAULT '1',
  `effect_time` date DEFAULT NULL COMMENT '生效日期',
  `lcu` varchar(20) DEFAULT NULL,
  `luu` varchar(20) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=501 DEFAULT CHARSET=utf8 COMMENT='員工表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_employee_reward`
--

DROP TABLE IF EXISTS `hr_employee_reward`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_employee_reward` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `employee_code` varchar(100) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `reward_id` int(11) NOT NULL,
  `reward_name` varchar(255) NOT NULL,
  `reward_money` varchar(255) DEFAULT NULL,
  `reward_goods` varchar(255) DEFAULT NULL,
  `remark` text,
  `reject_remark` text,
  `status` int(10) NOT NULL DEFAULT '0',
  `city` varchar(255) DEFAULT NULL,
  `lcu` varchar(255) DEFAULT NULL,
  `luu` varchar(255) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='員工獲獎列表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_employee_wages`
--

DROP TABLE IF EXISTS `hr_employee_wages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_employee_wages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city` varchar(40) DEFAULT NULL,
  `employee_id` int(10) unsigned NOT NULL,
  `wages_arr` text,
  `wages_date` date DEFAULT NULL,
  `wages_status` int(11) NOT NULL DEFAULT '0' COMMENT '0:草稿  1：發送 2：拒絕 3：完成',
  `just_remark` varchar(255) DEFAULT NULL,
  `apply_time` date DEFAULT NULL COMMENT '申請時間',
  `sum` varchar(50) DEFAULT NULL COMMENT '實際發放工資',
  `lcu` varchar(50) DEFAULT NULL,
  `luu` varchar(50) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='員工的工資表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_employee_word_info`
--

DROP TABLE IF EXISTS `hr_employee_word_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_employee_word_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `work_id` int(11) NOT NULL COMMENT '加班單id',
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='員工加班額外擴充的時間表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_employee_work`
--

DROP TABLE IF EXISTS `hr_employee_work`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_employee_work` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `work_code` varchar(255) DEFAULT NULL COMMENT '加班編號',
  `employee_id` varchar(200) NOT NULL COMMENT '員工id',
  `work_type` int(10) NOT NULL DEFAULT '0' COMMENT '加班類型',
  `work_cause` text COMMENT '加班原因',
  `work_address` varchar(255) DEFAULT NULL COMMENT '加班地點',
  `start_time` datetime DEFAULT NULL COMMENT '加班開始時間',
  `end_time` datetime DEFAULT NULL COMMENT '加班結束時間',
  `log_time` float(10,1) DEFAULT NULL COMMENT '加班總時長',
  `work_cost` float(10,2) DEFAULT NULL COMMENT '加班費用',
  `z_index` int(10) DEFAULT '1' COMMENT '審核層級（1:部門審核、2：主管、3：總監>、4：你）',
  `status` int(10) DEFAULT '0' COMMENT '審核的狀態(0:草稿、1：審核、2：審核通過、3：拒絕、4>：完成）',
  `user_lcu` varchar(255) DEFAULT NULL,
  `user_lcd` varchar(255) DEFAULT NULL,
  `area_lcu` varchar(255) DEFAULT NULL,
  `area_lcd` varchar(255) DEFAULT NULL,
  `head_lcu` varchar(255) DEFAULT NULL,
  `head_lcd` varchar(255) DEFAULT NULL,
  `you_lcu` varchar(255) DEFAULT NULL,
  `you_lcd` varchar(255) DEFAULT NULL,
  `reject_cause` text COMMENT '拒絕原因',
  `auto_cost` int(2) DEFAULT '1' COMMENT '費用是否自動計算（0：否、 1：是）',
  `audit_remark` text COMMENT '審核備註',
  `city` varchar(255) DEFAULT NULL,
  `lcu` varchar(255) DEFAULT NULL,
  `luu` varchar(255) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='員工加班表（新）';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_fete`
--

DROP TABLE IF EXISTS `hr_fete`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_fete` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '節假日名字',
  `start_time` date DEFAULT NULL,
  `end_time` date DEFAULT NULL,
  `log_time` int(11) DEFAULT NULL COMMENT '假日天數',
  `cost_num` int(11) DEFAULT '0' COMMENT '費用倍率（0：兩倍工資、1：三倍工資）',
  `city` varchar(255) DEFAULT NULL,
  `only` varchar(255) DEFAULT 'local',
  `lcu` varchar(255) DEFAULT NULL,
  `luu` varchar(255) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='節假日配置';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_holiday`
--

DROP TABLE IF EXISTS `hr_holiday`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_holiday` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `city` varchar(50) DEFAULT NULL,
  `z_index` varchar(50) DEFAULT NULL,
  `type` int(10) NOT NULL DEFAULT '0' COMMENT '0... 1...',
  `lcu` varchar(50) DEFAULT NULL,
  `luu` varchar(50) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='.....';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_plus_city`
--

DROP TABLE IF EXISTS `hr_plus_city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_plus_city` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `city` varchar(100) NOT NULL COMMENT '暫屬城市',
  `department` varchar(20) NOT NULL COMMENT '暫屬部門',
  `position` varchar(20) NOT NULL COMMENT '暫屬職位',
  `lcu` varchar(100) DEFAULT NULL,
  `luu` varchar(100) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='員工附加城市表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_prize`
--

DROP TABLE IF EXISTS `hr_prize`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_prize` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prize_date` date DEFAULT NULL COMMENT '嘉许日期',
  `prize_num` int(5) DEFAULT NULL COMMENT '参与人数',
  `employee_id` int(11) NOT NULL,
  `prize_pro` varchar(50) DEFAULT NULL COMMENT '嘉许项目',
  `customer_name` varchar(100) DEFAULT NULL COMMENT '客戶名稱',
  `contact` varchar(50) DEFAULT NULL COMMENT '聯繫人',
  `phone` varchar(50) DEFAULT NULL COMMENT '聯繫人電話',
  `posi` varchar(100) DEFAULT NULL COMMENT '聯繫人職務',
  `photo1` varchar(255) DEFAULT NULL COMMENT '表揚信（獨照）',
  `photo2` varchar(255) DEFAULT NULL COMMENT '與客戶合照',
  `prize_type` int(2) NOT NULL DEFAULT '0' COMMENT '0：表揚信  1：錦旗',
  `type_num` int(11) NOT NULL DEFAULT '0' COMMENT '錦旗數量',
  `status` int(5) DEFAULT '0' COMMENT '0:草稿  1：發送  2：拒絕  3：完成',
  `remark` text COMMENT '備註',
  `reject_remark` text COMMENT '拒絕原因',
  `city` varchar(100) DEFAULT NULL,
  `lcu` varchar(100) DEFAULT NULL,
  `luu` varchar(100) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='錦旗表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_queue`
--

DROP TABLE IF EXISTS `hr_queue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_queue` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rpt_desc` varchar(250) NOT NULL,
  `req_dt` datetime DEFAULT NULL,
  `fin_dt` datetime DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `status` char(1) NOT NULL,
  `rpt_type` varchar(10) NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rpt_content` longblob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_queue_param`
--

DROP TABLE IF EXISTS `hr_queue_param`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_queue_param` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `queue_id` int(10) unsigned NOT NULL,
  `param_field` varchar(50) NOT NULL,
  `param_value` varchar(500) DEFAULT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_queue_user`
--

DROP TABLE IF EXISTS `hr_queue_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_queue_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `queue_id` int(10) unsigned NOT NULL,
  `username` varchar(30) NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_review`
--

DROP TABLE IF EXISTS `hr_review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_review` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `year` int(11) NOT NULL DEFAULT '2019' COMMENT '評核年份',
  `year_type` int(11) NOT NULL DEFAULT '1' COMMENT '1:上半年  2：下半年',
  `id_list` text COMMENT '評核人id列表(json)',
  `id_s_list` varchar(255) NOT NULL COMMENT '考核人id（以逗號分割）',
  `name_list` varchar(255) NOT NULL COMMENT '評核人列表',
  `employee_remark` text COMMENT '員工的自我功績',
  `review_remark` text COMMENT '其它功績（主管填寫）',
  `strengths` text COMMENT '員工長處',
  `target` text COMMENT '員工目標',
  `improve` text COMMENT '改進',
  `tem_s_ist` text NOT NULL COMMENT '評核項目列表(json)',
  `tem_str` text NOT NULL,
  `review_sum` float(10,2) DEFAULT NULL COMMENT '評核總分',
  `status_type` int(11) NOT NULL DEFAULT '1' COMMENT '1:評核中  2：部分評核完成 3：評核成功 4：草稿',
  `review_type` int(2) NOT NULL DEFAULT '1' COMMENT '评核类型 1:正常 2:技术员 3:銷售 4:地區主管',
  `change_num` float(4,2) NOT NULL DEFAULT '0.00' COMMENT '請假天數（技術員）或者評核得分（銷售）',
  `lcu` varchar(255) DEFAULT NULL,
  `luu` varchar(255) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 COMMENT='員工分配表（評估）';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_review_h`
--

DROP TABLE IF EXISTS `hr_review_h`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_review_h` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `review_id` int(11) NOT NULL,
  `handle_id` int(11) NOT NULL COMMENT '審核人id',
  `handle_name` varchar(255) NOT NULL COMMENT '審核人名字',
  `handle_per` int(11) NOT NULL COMMENT '考核佔比（%）',
  `tem_s_ist` text NOT NULL COMMENT '評核項目列表(json)',
  `tem_sum` int(11) DEFAULT NULL COMMENT '考核项目的总数量',
  `review_remark` text COMMENT '其它功績',
  `strengths` text COMMENT '員工長處',
  `target` text COMMENT '員工目標',
  `improve` text COMMENT '改進',
  `review_sum` float(10,2) DEFAULT NULL COMMENT '評核總分',
  `four_with_sum` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '四用得分',
  `four_with_count` int(4) NOT NULL DEFAULT '0',
  `status_type` int(11) NOT NULL DEFAULT '1' COMMENT '1:待考核 3：評核成功 4：草稿',
  `lcu` varchar(255) DEFAULT NULL,
  `luu` varchar(255) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='審核列表（主管審核詳情）';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_reward`
--

DROP TABLE IF EXISTS `hr_reward`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_reward` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '獎勵名字',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '獎勵類型：0（僅獎金）、1（僅物品）、2（獎金加物品）',
  `money` varchar(100) DEFAULT NULL COMMENT '獎金',
  `goods` varchar(255) DEFAULT NULL COMMENT '獎勵物品',
  `city` varchar(100) DEFAULT NULL,
  `lcu` varchar(100) DEFAULT NULL,
  `luu` varchar(100) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='獎勵表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_sales_group`
--

DROP TABLE IF EXISTS `hr_sales_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_sales_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) NOT NULL COMMENT '組別名字',
  `city` varchar(255) NOT NULL,
  `local` int(11) NOT NULL DEFAULT '0' COMMENT '是否是本地可見 0：全局  1：本地',
  `lcu` varchar(255) DEFAULT NULL,
  `luu` varchar(255) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='銷售分組表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_sales_staff`
--

DROP TABLE IF EXISTS `hr_sales_staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_sales_staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL COMMENT '銷售組別的id',
  `employee_id` int(11) NOT NULL,
  `time_off` int(11) NOT NULL DEFAULT '0' COMMENT '時間段限制：0（不限制） 1（有限制）',
  `start_time` date DEFAULT NULL,
  `end_time` date DEFAULT NULL,
  `lcu` varchar(255) DEFAULT NULL,
  `luu` varchar(255) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_set`
--

DROP TABLE IF EXISTS `hr_set`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `set_name` varchar(255) NOT NULL,
  `z_index` int(11) NOT NULL DEFAULT '1',
  `set_type` int(11) NOT NULL DEFAULT '1' COMMENT '1:全部可見  2：進本城市可見',
  `four_with` int(2) NOT NULL DEFAULT '0' COMMENT '是否是四用 0：不是  1：是',
  `num_ratio` int(2) NOT NULL DEFAULT '1' COMMENT '基础分数倍率',
  `city` varchar(255) DEFAULT NULL,
  `lcu` varchar(255) DEFAULT NULL,
  `luu` varchar(255) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='審核項目配置表(子項）';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_set_pro`
--

DROP TABLE IF EXISTS `hr_set_pro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_set_pro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `set_id` int(11) NOT NULL,
  `pro_name` varchar(255) NOT NULL,
  `z_index` int(11) NOT NULL DEFAULT '1',
  `pro_type` int(11) NOT NULL DEFAULT '1' COMMENT '1:全部可見  2：進本城市可見',
  `city` varchar(255) DEFAULT NULL,
  `lcu` varchar(255) DEFAULT NULL,
  `luu` varchar(255) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8 COMMENT='審核項目配置表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_staff_year`
--

DROP TABLE IF EXISTS `hr_staff_year`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_staff_year` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(10) unsigned NOT NULL,
  `year` int(11) NOT NULL COMMENT '年',
  `add_num` float(10,1) NOT NULL COMMENT '年假累積的天數',
  `lcu` varchar(255) DEFAULT NULL,
  `luu` varchar(255) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_template`
--

DROP TABLE IF EXISTS `hr_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tem_name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `tem_str` text NOT NULL,
  `lcu` varchar(255) DEFAULT NULL,
  `luu` varchar(255) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=utf8 COMMENT='考核範本';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_template_employee`
--

DROP TABLE IF EXISTS `hr_template_employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_template_employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tem_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `id_list` text COMMENT '評核人id列表(json)',
  `id_s_list` varchar(255) NOT NULL COMMENT '考核人id（以逗號分割）',
  `name_list` varchar(255) NOT NULL COMMENT '評核人列表',
  `lcu` varchar(255) DEFAULT NULL,
  `luu` varchar(255) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='員工綁定考核模板';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_vacation`
--

DROP TABLE IF EXISTS `hr_vacation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_vacation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `vaca_type` varchar(10) NOT NULL DEFAULT 'A' COMMENT '假期種類',
  `log_bool` int(11) DEFAULT '0' COMMENT '是否有最大天數限制 0:無 1：有',
  `max_log` text,
  `ass_id` varchar(11) DEFAULT NULL COMMENT '關聯id（0：不關聯）',
  `ass_bool` int(11) NOT NULL DEFAULT '0',
  `ass_id_name` varchar(255) DEFAULT NULL,
  `sub_bool` int(11) DEFAULT '0' COMMENT '是否扣減工資  0：否  1：是',
  `sub_multiple` int(11) DEFAULT '0' COMMENT '扣減倍數（0-100）%',
  `city` varchar(255) DEFAULT NULL,
  `only` varchar(100) DEFAULT 'local',
  `lcu` varchar(255) DEFAULT NULL,
  `luu` varchar(255) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT NULL,
  `lud` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='請假配置表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_vacation_type`
--

DROP TABLE IF EXISTS `hr_vacation_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_vacation_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vaca_code` varchar(255) NOT NULL COMMENT '假期種類編號（E：年假）',
  `vaca_name` varchar(255) NOT NULL COMMENT '假期種類名字',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_wages`
--

DROP TABLE IF EXISTS `hr_wages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_wages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wages_name` varchar(30) NOT NULL COMMENT '工資組成名稱',
  `city` varchar(30) NOT NULL COMMENT '所在城市',
  `lcu` varchar(30) DEFAULT NULL,
  `luu` varchar(30) DEFAULT NULL,
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='工資配置表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_wages_con`
--

DROP TABLE IF EXISTS `hr_wages_con`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_wages_con` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wages_id` int(10) unsigned NOT NULL COMMENT '工資id',
  `type_name` varchar(30) NOT NULL COMMENT '屬性名稱',
  `compute` int(11) NOT NULL DEFAULT '0' COMMENT '計算方式：0（固定工資）、1（每小時工資）、2（提成百分比）',
  `z_index` int(11) NOT NULL DEFAULT '0' COMMENT '層級',
  `lcd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lud` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='工資組合表(配置)';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'hr'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-11 11:27:52
