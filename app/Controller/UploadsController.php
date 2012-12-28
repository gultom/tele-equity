<?php
App::import('Vendor', 'excel_reader2');
class UploadsController extends AppController{
	public $uses=array('Uploads','Upload','Duplicate');
	public function index(){
		//$this->layout = 'coba2';
	}
	public function import(){
		date_default_timezone_set('Asia/Jakarta');
		$date = date("Y-m-d H:i:s", time());
		//$this->layout = 'coba2';
		//print_r($this->request->data);
		$data = new Spreadsheet_Excel_Reader($this->request->data['Upload']['file']['tmp_name']);
		$baris = $data->rowcount($sheet_index=0);
		$this->set('jml',$data);$this->set('ttl',$data);
		
		
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
						
			$x = $this->Uploads->find('count',array('conditions'=> array('name'=>$nama, 'handphone1' => $mobile)));		
			echo $x;
				if($x == 0){
					$this->Uploads->create();
					$this->Uploads->save(
							array(
								'name'=>$nama,
								'birth_date'=>$dob1,
								'age'=>$age,
								'homephone1'=>$home_phone,
								'homephone2'=>$home_phone2,
								'officephone1'=>$off_phone,
								'officephone2'=>$off_phone2,
								'handphone1'=>$mobile,
								'handphone2'=>$mobile2,
								'home_addr1'=>$home_add1,
								'home_addr2'=>$home_add2,
								'home_addr3'=>$home_add3,
								'home_addr4'=>$home_add4,
								'home_city'=>$home_city,
								'home_zip'=>$home_zipcode,
								'company'=>$off_name,
								'office_addr1'=>$off_add1,
								'office_addr2'=>$off_add2,
								'office_city'=>$off_city,
								'office_zip'=>$off_zip,
								'insert_time'=>$date,
								'status'=>'clean'								
							));
				}
				else{
					
					$this->Uploads->create();
					$this->Uploads->save(
							array(
								'name'=>$nama,
								'birth_date'=>$dob1,
								'age'=>$age,
								'homephone1'=>$home_phone,
								'homephone2'=>$home_phone2,
								'officephone1'=>$off_phone,
								'officephone2'=>$off_phone2,
								'handphone1'=>$mobile,
								'handphone2'=>$mobile2,
								'home_addr1'=>$home_add1,
								'home_addr2'=>$home_add2,
								'home_addr3'=>$home_add3,
								'home_addr4'=>$home_add4,
								'home_city'=>$home_city,
								'home_zip'=>$home_zipcode,
								'company'=>$off_name,
								'office_addr1'=>$off_add1,
								'office_addr2'=>$off_add2,
								'office_city'=>$off_city,
								'office_zip'=>$off_zip,
								'insert_time'=>$date,
								'status'=>'duplicates'
							));
					}
					/*else{
						$id = $this->Duplicate->find('first',array('conditions'=> array('name'=>$nama)));
						$this->Duplicate->delete($id['Duplicate']['id']);
						$this->Duplicate->create();
						$this->Duplicate->save(
							array(
								'name'=>$nama,
								'birth_date'=>$dob1,
								'age'=>$age,
								'homephone1'=>$home_phone,
								'homephone2'=>$home_phone2,
								'officephone1'=>$off_phone,
								'officephone2'=>$off_phone2,
								'handphone1'=>$mobile,
								'handphone2'=>$mobile2,
								'home_addr1'=>$home_add1,
								'home_addr2'=>$home_add2,
								'home_addr3'=>$home_add3,
								'home_addr4'=>$home_add4,
								'home_city'=>$home_city,
								'home_zip'=>$home_zipcode,
								'company'=>$off_name,
								'office_addr1'=>$off_add1,
								'office_addr2'=>$off_add2,
								'office_city'=>$off_city,
								'office_zip'=>$off_zip,
								'insert_time'=>$date
							));
					}
					}*/
				}	
					
				$this->redirect('sortir');
			}
		public function save(){
			$data = $this->Uploads->find('all');
			//print_r($this->request->data);
			$jml = $this->Uploads->find('count',array('conditions'=> array('status'=>'clean')));
			
			for($i=0; $i<=$jml; $i++){
			$jmlduplicate = $this->Upload->find('count',array('conditions'=> array('name'=>$data[$i]['Uploads']['name'],'handphone1'=>$data[$i]['Uploads']['handphone1'])));
			echo $jmlduplicate;
			if($jmlduplicate == 0) {
				
					$this->Upload->create();
					$this->Upload->save(
								array(
									'batch_no'=>$this->request->data['champaign'],
									'name'=>$data[$i]['Uploads']['name'],
									'birth_date'=>$data[$i]['Uploads']['birth_date'],
									'homephone1'=>$data[$i]['Uploads']['homephone1'],
									'homephone2'=>$data[$i]['Uploads']['homephone2'],
									'officephone1'=>$data[$i]['Uploads']['officephone1'],
									'officephone2'=>$data[$i]['Uploads']['officephone2'],
									'handphone1'=>$data[$i]['Uploads']['handphone1'],
									'handphone2'=>$data[$i]['Uploads']['handphone2'],
									'home_addr1'=>$data[$i]['Uploads']['home_addr1'],
									'home_addr2'=>$data[$i]['Uploads']['home_addr2'],
									'home_addr3'=>$data[$i]['Uploads']['home_addr3'],
									'home_addr4'=>$data[$i]['Uploads']['home_addr4'],
									'home_city'=>$data[$i]['Uploads']['home_city'],
									'home_zip'=>$data[$i]['Uploads']['home_zip'],
									'company'=>$data[$i]['Uploads']['company'],
									'office_addr1'=>$data[$i]['Uploads']['office_addr1'],
									'office_addr2'=>$data[$i]['Uploads']['office_addr2'],
									'office_city'=>$data[$i]['Uploads']['office_city'],
									'office_zip'=>$data[$i]['Uploads']['office_zip'],
									'insert_time'=>$data[$i]['Uploads']['insert_time']
								));
					$this->Uploads->deleteAll();
				}
				else {
					$this->Duplicate->create();
					$this->Duplicate->save(
								array(
									'batch_no'=>$this->request->data['champaign'],
									'name'=>$data[$i]['Uploads']['name'],
									'birth_date'=>$data[$i]['Uploads']['birth_date'],
									'homephone1'=>$data[$i]['Uploads']['homephone1'],
									'homephone2'=>$data[$i]['Uploads']['homephone2'],
									'officephone1'=>$data[$i]['Uploads']['officephone1'],
									'officephone2'=>$data[$i]['Uploads']['officephone2'],
									'handphone1'=>$data[$i]['Uploads']['handphone1'],
									'handphone2'=>$data[$i]['Uploads']['handphone2'],
									'home_addr1'=>$data[$i]['Uploads']['home_addr1'],
									'home_addr2'=>$data[$i]['Uploads']['home_addr2'],
									'home_addr3'=>$data[$i]['Uploads']['home_addr3'],
									'home_addr4'=>$data[$i]['Uploads']['home_addr4'],
									'home_city'=>$data[$i]['Uploads']['home_city'],
									'home_zip'=>$data[$i]['Uploads']['home_zip'],
									'company'=>$data[$i]['Uploads']['company'],
									'office_addr1'=>$data[$i]['Uploads']['office_addr1'],
									'office_addr2'=>$data[$i]['Uploads']['office_addr2'],
									'office_city'=>$data[$i]['Uploads']['office_city'],
									'office_zip'=>$data[$i]['Uploads']['office_zip'],
									'insert_time'=>$data[$i]['Uploads']['insert_time']
								));
				}
								
			}
			$this->redirect(array('controller'=>'customers','action'=>'view'));
		}
		public function display(){
					$this->set('list', $this->Uploads->find('all'));

		}
		public function sortir(){
				$this->layout = 'default';
			    $this->set('clean',$this->Uploads->find('all'));
				$this->set('duplicate',$this->Duplicate->find('all'));
		}
	
}