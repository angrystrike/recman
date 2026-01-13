# Custom Framework project

This is a minimal PHP project with user registration and login to showcase the custom framework abilities. No need for frameworks, Docker or package managers.

---

## 🚀 Quick Setup

1. **Create a MySQL database locally**  
   Make sure you have MySQL running and create a new database for this project.

2. **Configure database credentials**  
   Create `config/params.php` and add your database credentials and other secrets.

3. **Run the SQL migration**  
   Execute the SQL scripts from the `/sql` folder to create the necessary tables.

4. **Start the PHP server**  
   For simplicity, this project uses the built-in PHP server. Run this in the project root:

   ```bash
   php -S localhost:8000

4. **Open the project in your browser**

    / — Registration form <br>
    /login — Login form
