<?php
namespace App\Controllers;
use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $data['users'] = $model->findAll();
        return view('users/index', $data);
    }

    public function new()
    {
        helper('form');
        return view('users/new');
    }

    public function create()
    {
        helper('form');
        $rules = [
            'username'  => 'required|is_unique[users.username]',
            'full_name' => 'required',
            'email'     => 'required|valid_email'
        ];

        if (!$this->validate($rules)) {
            return view('users/new', ['validation' => $this->validator]);
        }

        $model = new UserModel();
        $model->save([
            'username'  => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
            'email'     => $this->request->getPost('email')
        ]);

        return redirect()->to('/users');
    }

    public function edit($id)
    {
        helper('form');
        $model = new UserModel();
        $data['user'] = $model->find($id);
        return view('users/edit', $data);
    }

    public function update($id)
    {
        helper(['form', 'url']);
        $model = new UserModel();

        $updateData = [
            'username'  => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
            'email'     => $this->request->getPost('email')
        ];

        // Native PHP file upload to guarantee it saves
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['avatar']['tmp_name'];
            $fileName = $_FILES['avatar']['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            if (in_array($fileExtension, $allowedExtensions)) {
                $newFileName = time() . '_' . rand(1000, 9999) . '.' . $fileExtension;
                $uploadPath = FCPATH . 'uploads/';
                
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
                
                if (move_uploaded_file($fileTmpPath, $uploadPath . $newFileName)) {
                    $updateData['avatar'] = $newFileName;
                }
            }
        }

        $model->update($id, $updateData);
        return redirect()->to('/users');
    }

    public function delete($id)
    {
        $model = new UserModel();
        $model->delete($id);
        return redirect()->to('/users');
    }
}