<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f9fafb;
            color: #374151;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        .container {
            max-width: 600px;
            padding: 20px;
        }

        .heading {
            font-size: 6rem;
            font-weight: 600;
            color: #3b82f6;
        }

        .subheading {
            font-size: 1.5rem;
            margin: 20px 0;
            color: #6b7280;
        }

        .illustration {
            width: 150px;
            margin: 20px auto;
        }

        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 24px;
            background-color: #3b82f6;
            color: #fff;
            font-size: 1rem;
            border-radius: 8px;
            text-decoration: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #2563eb;
        }

        .tip {
            margin-top: 30px;
            font-size: 1rem;
            color: #6b7280;
        }

        .tip i {
            color: #3b82f6;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="heading">404</div>
        <p class="subheading">Oops! The page you’re looking for doesn’t exist.</p>
        <img src="https://img.icons8.com/ios/150/checklist--v2.png" alt="Task Illustration" class="illustration">
        <p class="tip">
            <i class="fas fa-lightbulb"></i>
            Don’t worry, you can always go back to your tasks or activities!
        </p>
        <a href="/" class="button">Go Back to Dashboard</a>
    </div>
</body>

</html>
