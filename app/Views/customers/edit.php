<!DOCTYPE html>
<html>
<head>
    <title>Edit Customer</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f0f4f8; color: #334155; margin: 0; padding: 40px 20px; }
        .container { max-width: 500px; margin: 0 auto; background: #ffffff; padding: 30px 40px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); }
        h1 { color: #1e293b; margin-top: 0; }
        label { font-weight: bold; display: block; margin-top: 15px; margin-bottom: 5px; }
        input[type="text"] { width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 5px; box-sizing: border-box; }
        button { margin-top: 20px; background-color: #10b981; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; width: 100%; font-size: 16px; }
        button:hover { background-color: #059669; }
        .error { color: #ef4444; background: #fee2e2; padding: 10px; border-radius: 5px; margin-bottom: 15px; }
        .back-link { display: inline-block; margin-bottom: 20px; color: #64748b; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <a href="<?= base_url('/customers') ?>" class="back-link">← Back to Customers</a>
        <h1>Edit Customer</h1>

        <?php if (isset($validation)): ?>
            <div class="error">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('/customers/update/'.$customer['id']) ?>" method="post">
            <label>Full Name</label>
            <!-- Uses set_value() to keep user input if validation fails, falling back to DB data -->
            <input type="text" name="full_name" value="<?= set_value('full_name', $customer['full_name']) ?>">

            <label>Email Address</label>
            <input type="text" name="email" value="<?= set_value('email', $customer['email']) ?>">

            <button type="submit">Update Customer</button>
        </form>
    </div>
</body>
</html>