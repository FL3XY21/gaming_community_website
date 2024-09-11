# Gaming Website

## Setup

1. Install XAMPP and start Apache and MySQL.
2. Place this directory inside `htdocs` of your XAMPP installation.
3. Create a database named `gaming_website` and set up the necessary tables.
4. Access the website via `http://localhost/gaming_website/`.

## File Structure

- `includes/config.php`: Database configuration.
- `includes/header.php`: Header template.
- `css/styles.css`: CSS styles.
- `js/scripts.js`: JavaScript functionality.
- `admin/`: Admin-related pages.
- `user/`: User-related pages.

## Notes

- Update database credentials in `config.php` if needed.
- Ensure that file and directory permissions are correctly set for your environment.





<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4; /* Light background color */
            display: flex;
        }

        .sidebar {
            width: 20%;
            height: 100vh;
            background: #0075ff;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
        }

        .logo {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            overflow: hidden;
            margin: 36px;
            text-align: center;
        }

        .logo img {
            width: 100%;
            height: auto;
        }

        .main-content {
            margin-left: 20%; /* Space for sidebar */
            padding: 20px;
            width: 80%; /* Main content width */
        }

        h1 {
            text-align: center;
            color: #000; /* Dark color for text */
            margin: 20px 0;
        }

        .tabs {
            display: flex;
            justify-content: space-around;
            align-items: center;
            background-color: #fff; /* Background color for tabs */
            border-bottom: 2px solid #ddd;
            padding: 10px 0;
            margin: 0;
        }

        .tabs button {
            background-color: #f1f1f1;
            border: none;
            padding: 14px 20px;
            cursor: pointer;
            margin: 0;
            flex: 1; /* Equal width for tabs */
            text-align: center;
            transition: background-color 0.3s;
        }

        .tabs button.active {
            background-color: #ddd;
        }

        .tabs button:hover {
            background-color: #ddd;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff; /* White background for table */
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            background-color: #fff; /* White background for table cells */
        }

        th {
            background-color: #f4f4f4; /* Light gray background for table headers */
        }

        .edit-button, .delete-button {
            padding: 5px 10px;
            margin: 2px;
            cursor: pointer;
            border: none;
            color: #fff; /* White text color for buttons */
        }

        .edit-button {
            background-color: #4CAF50; /* Green */
        }

        .delete-button {
            background-color: #f44336; /* Red */
        }

        .logout-button {
            background-color: #f44336; /* Red */
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            margin-left: auto;
            display: block;
        }