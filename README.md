# Codeigniter 4 Basic admin panel 

This project is for Codeigniter 4 setup with admin panel

## INSTALLATION

Please check the official Codeigniter installation guide for server requirements before you start. [Codeigniter installation](https://codeigniter.com/user_guide/installation/index.html)

1. Clone the repository to your local machine

2. Go to folder in which clone is taken `cd project-repository`

3. Install all the dependencies using composer `composer install`

4. Setup .env file using **env** according your environment

5. Run the migration `php spark migrate`

6. Run the seed data `php spark db:seed User`
    
    This will create super admin into database, so you can login with that user.

7. Run `php spark serve`

Now we can see the development server started at http:localhost:8080
