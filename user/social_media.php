<?php include '../includes/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <style>
.container {
    background-color: transparent; /* Light grey background for the container */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.left {
    background-color:  rgba(0, 0, 0, 0.4); /* Dark background for the left section */
    color: #ffffff; /* White text color */
    padding: 20px;
    border-radius: 10px;
}

.left h1 {
    font-size: 4rem;
    margin-bottom: 20px;
    font-weight: bold;
}

.left p {
    font-size: 1.5rem;
    margin-bottom: 20px;
}

.email, .social {
    margin-bottom: 20px;
}

.email p, .social li {
    font-size: 1.5rem;
    font-weight:bold;
}

.social {
    list-style: none;
    padding: 0;
}

.social li {
    margin: 5px 0;
}

.right {
    background-color:rgba(0, 0, 0, 0.4); /* White background for the right section */
    padding: 20px;
    border-radius: 10px;
    color: #fff;
}

.right .form-control, .right .form-select {
    margin-bottom: 15px;
}

.right .btn-primary {
    background-color: #007bff; /* Bootstrap primary color */
    border: none;
}

.right .btn-primary:hover {
    background-color: #0056b3; /* Darker shade for hover effect */
}

.right .form-label {
    font-weight: bold;
}
</style>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Bootstrap CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col col-lg-6">
                <div class="left">
                    <h1>CONTACT US </h1>
                    <p>Hello, it's really a pain to be followed by an adipiscing developer. Expedited, for resilience provides the most worthy of pleasure to obtain pains? For the pains of these are bound less by the flexibility that escapes,</p>
                    <div class="email">
                        <p><i class='bx bxs-envelope'></i>KRISH@GMAIL.COM</p>
                    </div>
                    <div class="social">
                        
                        <ul>
                            <li><a href="https://www.facebook.com/login/"><i class='bx bxl-instagram' ></a></i> Instagram</li>
                            <li> <a href="https://discord.gg/ABGkwkyv"><i class='bx bxl-discord-alt' ></i></a>Discord</li>
                            <li><a href="https://github.com/FL3XY21"><i class='bx bxl-github' ></i></a> GitHub</li>
                        </ul>
                    </div>
                </div>
            </div><!--col end--->
            
            <div class="col col-lg-6">
                <div class="right">
                    <form action="submit_contact.php" method="POST">
                        <label for="name" class="form-label">Name</label> <br />
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" required /> <br />
                        
                        <label for="email" class="form-label">Email</label> <br />
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter Your Email" required /> <br />
                        
                        <label for="problem" class="form-label">Select</label> <br />
                        <select id="problem" name="problem" class="form-select">
                            <option value="">Select</option>
                            <option value="Problem 1">LOGIN</option>
                            <option value="Problem 2">FRONTEND</option>
                            <option value="Problem 3">DATABASE</option>
                            <option value="Problem 4">OTHER</option>
                        </select> <br />
                        
                        <label for="message" class="form-label">Message</label> <br />
                        <textarea id="message" name="message" cols="30" rows="3" class="form-control" placeholder="Enter Your Message" required></textarea> <br />
                        
                        <button class="btn btn-primary" type="submit">Submit Query</button>
                    </form>
                </div>
            </div> <!--col end--->
        </div> <!--row end-->
    </div> <!--container end--->
</body>
</html>
