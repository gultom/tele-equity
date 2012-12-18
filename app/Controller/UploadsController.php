<?php
App::import('Vendor', 'excel_reader2');
class UploadsController extends AppController{
	public $uses=array('Uploads','Sort','Duplicate');
	public function index(){
		//$this->layout = 'coba2';
	}
	public function import(){
		//$this->layout = 'coba2';
		//print_r($this->request->data);
		$data = new Spreadsheet_Excel_Reader($this->request->data['Upload']['file']['tmp_name']);
		$baris = $data->rowcount($sheet_index=0);
		
		// import data excel mulai baris ke-2
		// (karena baris pertama adalah nama kolom)
		//print_r($data[1]);
		for($i=2; $i<=$baris; $i++){
			$nama = $data->val($i, 2);
			$ttl = $data->val($i, 3);
			$age = $data->val($i, 4);
			$home_phone = $data->val($i, 5);
			$home_phone2 = $data->val($i, 6);
			$off_phone = $data->val($i, 7);
			$off_phone2 = $data->val($i, 8);
			$mobile = $data->val($i, 9);
			$mobile2 = $data->val($i, 10);
			$home_add1 = $data->val($i, 11);
			$home_add2 = $data->val($i, 12);
			$home_add3 = $data->val($i, 13);
			$home_add4 = $data->val($i, 14);
			$home_city = $data->val($i, 15);
			$home_zipcode = $data->val($i, 16);
			$off_name = $data->val($i, 17);
			$off_add1 = $data->val($i, 18);
			$off_add2 = $data->val($i, 19);
			$off_city = $data->val($i, 20);
			$off_zip = $data->val($i, 21);
			$vid = $data->val($i, 22);
			$vcampaign = $data->val($i, 23);
			$vagent = $data->val($i, 24);
			$vcode = $data->val($i, 25);
			$dob=explode('/',$ttl);
			$dob1=$dob[2].'-'.$dob[0].'-'.$dob[1];
			
			$x = $this->Uploads->find('count',array('conditions'=> array('prospect_name'=>$nama, 'mobile_phone' => $mobile)));		
			echo $x;
				if($x == 0){
					$this->Uploads->create();
					$this->Uploads->save(
							array(
								'prospect_name'=>$nama,
								'date_of_birth'=>$dob1,
								'age'=>$age,
								'home_phone'=>$home_phone,
								'home_phone2'=>$home_phone2,
								'office_phone'=>$off_phone,
								'office_phone2'=>$off_phone2,
								'mobile_phone'=>$mobile,
								'mobile_phone2'=>$mobile2,
								'address1'=>$home_add1,
								'address2'=>$home_add2,
								'address3'=>$home_add3,
								'address4'=>$home_add4,
								'city'=>$home_city,
								'zipcode'=>$home_zipcode,
								'company_name'=>$off_name,
								'office_address'=>$off_add1,
								'office_address2'=>$off_add2,
								'office_city'=>$off_city,
								'office_zipcode'=>$off_zip,
								'vid'=>$vid,
								'vcampaign'=>$vcampaign,
								'vagent'=>$vagent,
								'vcode'=>$vcode,
								'status'=>'Clean'
							));
				}
				else{
					$z = $this->Duplicate->find('count',array('conditions'=> array('prospect_name'=>$nama)));
					echo $z;
					if($z == 0){
					$this->Duplicate->create();
					$this->Duplicate->save(
							array(
								'prospect_name'=>$nama,
								'date_of_birth'=>$dob1,
								'age'=>$age,
								'home_phone'=>$home_phone,
								'home_phone2'=>$home_phone2,
								'office_phone'=>$off_phone,
								'office_phone2'=>$off_phone2,
								'mobile_phone'=>$mobile,
								'mobile_phone2'=>$mobile2,
								'address1'=>$home_add1,
								'address2'=>$home_add2,
								'address3'=>$home_add3,
								'address4'=>$home_add4,
								'city'=>$home_city,
								'zipcode'=>$home_zipcode,
								'company_name'=>$off_name,
								'office_address'=>$off_add1,
								'office_address2'=>$off_add2,
								'office_city'=>$off_city,
								'office_zipcode'=>$off_zip,
								'vid'=>$vid,
								'vcampaign'=>$vcampaign,
								'vagent'=>$vagent,
								'vcode'=>$vcode,
								'status'=>'Duplicate'
							));
					}
					else{
						$id = $this->Duplicate->find('first',array('conditions'=> array('prospect_name'=>$nama)));
						$this->Duplicate->delete($id['Duplicate']['id']);
						$this->Duplicate->create();
						$this->Duplicate->save(
							array(
								'prospect_name'=>$nama,
								'date_of_birth'=>$dob1,
								'age'=>$age,
								'home_phone'=>$home_phone,
								'home_phone2'=>$home_phone2,
								'office_phone'=>$off_phone,
								'office_phone2'=>$off_phone2,
								'mobile_phone'=>$mobile,
								'mobile_phone2'=>$mobile2,
								'address1'=>$home_add1,
								'address2'=>$home_add2,
								'address3'=>$home_add3,
								'address4'=>$home_add4,
								'city'=>$home_city,
								'zipcode'=>$home_zipcode,
								'company_name'=>$off_name,
								'office_address'=>$off_add1,
								'office_address2'=>$off_add2,
								'office_city'=>$off_city,
								'office_zipcode'=>$off_zip,
								'vid'=>$vid,
								'vcampaign'=>$vcampaign,
								'vagent'=>$vagent,
								'vcode'=>$vcode,
								'status'=>'Duplicate2'
							));
					}
					}
				}	
					
				$this->redirect('sortir');
			}
		public function display(){
					$this->set('list', $this->Uploads->find('all'));

		}
		public function sortir(){
			    $this->set('clean',$this->Sort->find('all'));
				$this->set('duplicate',$this->Duplicate->find('all'));
		}
	
}