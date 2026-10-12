<?php
namespace App\Controllers;
use App\Models\CustomerModel;

class CustomerController extends BaseController
{
    public function index()
    {
        $model = new CustomerModel();
        $data['customers'] = $model->findAll();
        return view('customers/index', $data);
    }

    public function new()
    {
        helper('form');
        return view('customers/new');
    }

    public function create()
    {
        helper('form');
        $rules = [
            'full_name' => 'required',
            'email'     => 'required|valid_email'
        ];

        if (!$this->validate($rules)) {
            return view('customers/new', ['validation' => $this->validator]);
        }

        $model = new CustomerModel();
        $model->save([
            'full_name' => $this->request->getPost('full_name'),
            'email'     => $this->request->getPost('email')
        ]);

        return redirect()->to('/customers');
    }

    public function edit($id)
    {
        helper('form');
        $model = new CustomerModel();
        $data['customer'] = $model->find($id);
        return view('customers/edit', $data);
    }

    public function update($id)
    {
        helper('form');
        $model = new CustomerModel();
        
        $rules = [
            'full_name' => 'required',
            'email'     => 'required|valid_email'
        ];

        if (!$this->validate($rules)) {
            $data['customer'] = $model->find($id);
            $data['validation'] = $this->validator;
            return view('customers/edit', $data);
        }

        $model->update($id, [
            'full_name' => $this->request->getPost('full_name'),
            'email'     => $this->request->getPost('email')
        ]);

        return redirect()->to('/customers');
    }
    public function delete($id)
    {
        $model = new CustomerModel();
        $model->delete($id);
        return redirect()->to('/customers');
    }
}