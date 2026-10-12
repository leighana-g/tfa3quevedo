<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 40px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        h1 {
            color: #1e293b;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: 600;
            color: #475569;
            margin-bottom: 6px;
        }
        input[type="text"], input[type="email"], input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            box-sizing: border-box;
        }
        .btn-success {
            background-color: #10b981;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }
        .btn-success:hover {
            background-color: #059669;
        }
        .back-link {
            display: inline-block;
            margin-bottom: 15px;
            color: #64748b;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        .error {
            color: #ef4444;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="<?= base_url('/users') ?>" class="back-link">&larr; Back to Users</a>
        <h1>Edit User</h1>

        <?php if (isset($validation)): ?>
            <div class="error" style="margin-bottom: 15px;">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('/users/update/' . $user['id']) ?>" method="post" enctype="multipart/form-data">
            
            <div class="form-group">
                <label>Profile Avatar (Optional)</label>
                <?php if (!empty($user['avatar'])): ?>
                    <div style="margin-bottom: 8px;">
                        <img src="<?= base_url('uploads/' . $user['avatar']) ?>" alt="Current Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                    </div>
                <?php endif; ?>
                <input type="file" name="avatar">
                <small style="color: #64748b;">Max 2MB. JPG or PNG only.</small>
            </div>

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" value="<?= old('username', $user['username']) ?>">
            </div>

            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="full_name" value="<?= old('full_name', $user['full_name']) ?>">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?= old('email', $user['email']) ?>">
            </div>

            <button type="submit" class="btn-success">Update User</button>
        </form>
    </div>
</body>
</html>