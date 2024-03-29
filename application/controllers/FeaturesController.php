<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class FeaturesController extends MY_Controller {
	
	private $error;

	public function index(){
		$data['features'] = $this->FeatureRoomModel->getFeatures();
		$data['user'] = $this->session->userdata();
		$data['error'] = $this->error;
		$this->template->load('template/template','features/featuresView', $data);
	}
	public function newFeature(){
		$this->form_validation->set_rules('name', 'fieldlabel', 'required');
		$this->form_validation->set_rules('description', 'fieldlabel', 'required');
		if($this->form_validation->run()){
			$id_user = $this->session->userdata('id_user');
			$feature = array(
				'id_user' => $id_user,
				'name_feature' => $this->input->post('name'),
				'description_feature' => $this->input->post('description'),
				);
			if(!$this->FeatureRoomModel->newFeature($feature)){
				echo "Falha ao enviar fomulário!";
			}else{
				echo "Formulário enviado!";
			}
		}else{
			$data['user'] = $this->session->userdata();
			$this->template->load('template/template', 'features/newFeaturesView',$data);
		}
	}
	public function delete($id){	


		if($this->FeatureRoomModel->delete($id)){
			redirect('caracteristicas','refresh');
		}else{
			$this->error = "Característica sendo usada!";
			$this->index();
		}
		
	}
}
/* End of file FeatureRoomController.php */
/* Location: ./application/controllers/FeatureRoomController.php */