
        /* CSS styles for the sidebar */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            /* Dark background color */
            padding-top: 20px;
            color: #fff;
            /* Text color */
            overflow-y: auto;
            /* Enable scrolling if content exceeds height */
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar a {
            display: block;
            padding: 10px 15px;
            text-decoration: none;
            color: #fff;
        }

        .sidebar a:hover {
            background-color: #495057;
            /* Darker background color on hover */
        }

        /* CSS styles for the main content */
        .content {
            margin-left: 250px;
            /* Adjust this value to match the width of your sidebar */
            padding: 20px;
        }

        .profile-pic img {
            border-radius: 50%;
            /* Make the profile picture round */
        }

        h1 {
            color: #495057;
            /* Text color for the heading */
        }
    