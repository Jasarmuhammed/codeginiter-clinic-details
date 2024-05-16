<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctologin</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">.
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
   body {
      .logout-btn {
        padding: 8px 16px;
        border-radius: 3px;
        text-decoration: none;
        position: absolute;
        top: 05px;
        right: 10px;
    }
      .login-container {
          max-width: 400px;
          margin: 0 auto;
          padding: 20px;
          border: 1px solid #ccc;
          border-radius: 5px;
          background-color: #f9f9f9;
          box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      }
      .login-container h2 {
          text-align: center;
      }
      .form-group {
          margin-bottom: 15px;
      }
      .form-group label {
          display: block;
          margin-bottom: 5px;
      }
      .form-group input[type="text"],
      .form-group input[type="password"] {
          width: 100%;
          padding: 8px;
          border: 1px solid #ccc;
          border-radius: 3px;
      }
      .form-group input[type="submit"] {
          width: 100%;
          padding: 10px;
          border: none;
          border-radius: 3px;
          background-color: #007bff;
          color: #fff;
          cursor: pointer;
      }
      .form-group input[type="submit"]:hover {
          background-color: #0056b3;
      }
    .box-datatable {
      margin-top: 20px;
    }

    .myInputFilter {
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 10px;
      border: 1px solid #ccc;
    }
    .custom-icon {
    color: red;
}

    th {
      background-color: #007bff;
      color: #fff;
    }
    .container {
      display: flex;
      flex-wrap: wrap;
    }

    .form-container,
    .list-container {
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 20px;
      margin-bottom: 20px;
    }

    .form-container {
      width: 300px;
      margin-right: 20px;
    }

    .list-container {
      flex-grow: 1;
    }

    .logout-btn {
      display: block;
      margin-bottom: 10px;
      color: red;
    }

   
    @media (max-width: 768px) {
      .form-container {
        width: 100%;
        margin-right: 0;
        margin-bottom: 20px;
      }

      .list-container {
        width: 100%;
      }
    }
  </style>
</head>
