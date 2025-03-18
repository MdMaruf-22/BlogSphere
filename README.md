# Project Title: Edge Blog

## Description
This project is a web application that allows users to create, edit, and delete posts. Users can also comment on posts, like posts, and search for posts. The application includes an admin panel for managing categories, posts, and comments.

## Setup Instructions
1. Clone the repository:
    ```sh
    git clone https://github.com/your-username/your-repo.git
    ```
2. Navigate to the project directory:
    ```sh
    cd your-repo
    ```
3. Set up your web server (e.g., Apache, Nginx) to serve the project files.
4. Import the database schema (if applicable) from the `database.sql` file.
5. Configure the database connection in the `includes/config.php` file.
6. Start the web server and navigate to the project URL in your browser.

## Usage
- **Home Page**: Visit `index.php` to view the latest posts.
- **Create Post**: Use `createPostSubmit.php` to create a new post.
- **Edit Post**: Use `edit_post.php` to edit an existing post.
- **Delete Post**: Use `delete_post.php` to delete a post.
- **Comment on Post**: Use `add_comment.php` to add a comment to a post.
- **Delete Comment**: Use `delete_comment.php` to delete a comment.
- **Like Post**: Use `like_post.php` to like a post.
- **Search Posts**: Use `search.php` to search for posts.
- **Admin Panel**: Access the admin panel at `admin/index.php` to manage categories, posts, and comments.

## File Structure
```
d:/xampp/htdocs/edge_course/
├── about.php
├── category.php
├── index.php
├── includes/
│   ├── db.php
│   ├── footer.php
│   └── header.php
├── admin/
│   ├── add_category.php
│   ├── delete.php
│   └── ...
├── css/
│   └── bootstrap.min.css
├── js/
│   └── bootstrap.bundle.min.js
└── images/
    └── blogs/
```

## Contributor Guidelines
I welcome contributions to this project! To contribute, please follow these steps:
1. Fork the repository.
2. Create a new branch for your feature or bugfix:
    ```sh
    git checkout -b feature-name
    ```
3. Make your changes and commit them with a descriptive message:
    ```sh
    git commit -m "Add new feature"
    ```
4. Push your changes to your forked repository:
    ```sh
    git push origin feature-name
    ```
5. Open a pull request to the main repository with a description of your changes.


## About the Creator
Hello! I'm Mohammed Maruf Islam. I created this project while learning PHP as part of the EDGE course. This project is a part of my journey in Software Engineering at Noakhali Science and Technology University.

## Contact Information
For any questions or issues, please contact the project maintainer at [marufislam74208@gmail.com](mailto:marufislam74208@gmail.com).
