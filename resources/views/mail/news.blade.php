<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Announcement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .container-fluid {
            padding: 20px;
        }
        .text-center {
            text-align: center;
        }
        .BackGround {
            box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            background-color: white;
            padding: 20px;
            margin: auto;
            max-width: 800px;
        }
        .bg-primary-subtle {
            background-color: #e9ecef;
            color: #212529;
            /* padding: 15px; */
            border-radius: 5px;
        }
        .link-button {
            display: inline-block;
            padding: 10px 30px;
            /* color: white; */
            /* background-color: #007bff; */
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .link-button:hover {
            background-color: #0056b3;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
       <div class="text-center mt-2">
            <img src="{{ $message->embed('images/CompanyLogo/nanosoftSolutions Company Logo.png') }}" alt="Company Logo">
            <h2 style="color: rgb(48, 2, 255)">Announcements from NanoSoft Solutions</h2>
        </div>

        <div class="row d-flex justify-content-center mb-2">
            <div class="BackGround">
                <p class="bg-primary-subtle text-center">
                    <span>
                        {{ $announcement }}
                    </span>  
                    
                    <br>

                    <div style="text-align: center; margin-top: 20px;">
                        <a href="#" class="link-button">Visit to Institute Complaint Web Application</a>
                    </div>
                </p>
            </div>
        </div>
    </div>
</body>
</h
