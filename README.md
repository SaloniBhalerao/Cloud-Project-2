UNIVERSITY NAME- SAN JOSE STATE UNIVERSITY

COURSE - CLOUD TECHNOLOGIES

PROFESSOR - SANJAY GARJE

ISA- DIVYANKITHA URS

STUDENT NAME- 

Tarun Shetty           Linkedin Link - https://www.linkedin.com/in/tarun-shetty-273952140/

Saloni Sharad Bhalerao Linkedin Link - https://www.linkedin.com/in/saloni-bhalerao-52984513a

Yamini Muralidharen   Linkedin Link    https://www.linkedin.com/in/yaminimuralidharen/ 

Anu Sebastian         Linkedin Link    https://www.linkedin.com/in/anu-sebastian-7583113/


PROJECT INTRODUCTION

People waste an unfathomable amount of food! According to the Guardian report released roughly fifty percent of all produce in the United States is thrown away, for example around 60 million tons worth of produce annually, an amount constituting "one-third of all foodstuff". Wasted food is also the biggest occupant in American landfills, the Environmental Protection agency has found when it comes to catering food for attendees at events, the food is always ordered in excess. On the other hand, there are many people in the society, who are in need for food and this excess food from the above events can fulfil their needs. Controlling food wastage is one of the concerning issues for any nation therefore, we have taken a pledge to march towards reduction of food wastage and providing it to the needy. 
The web application we have planned will let event organizers to notify volunteers belonging to social organizations that can come and pick up the excess food which in-turn will help the wellbeing of the society. This application will be a 3-tier scalable web based application which will leverage the Amazon Web Services.
There are 2 groups of registered users to this web application: -
1.	Event organizers. 
2.	Volunteers of social organizations.
Event organizers will inform about the excess food with location details so that the nearby volunteers can come and pick up the food.


FEATURES LIST

The list of features which a user can do are.

SIGN IN- User has to get in by providing his centennials.

UPLOAD- User can upload a file into a S3 bucket (maximum size is 10mb.

DELETE- The user can delete the file

DOWNLOAD- The user can download the file which is in S3 bucket.

FORGOT PASSWORD- The user gets a new password to his mail.

LOGOUT- The user will be logged out.

•	Create event

•	View event

•	Update a new event.

•	View the event along with the details of the location

•	Social Organizers can pick up food.

•	Upload details of available food.


There is a table which displays the details of the events posted by event organizers.

Event Organizers

•	Individuals or and groups who host parties or prepare food.

•	Registers in our portal.

•	Publish the event details.

•	Can upload images or files to provide information about the food
     e.g. How many people can it serve.
     
        List of food items
        
Social Organizations

•	NGO , FOOD BANKS or any other communities which provide food and feed the hungry.

•	Initially they have to register in our web portal.

•	Can see the list of events where the food is available.

•	Mark events if they need food.

•	Responsible for picking up food from event organizers.







PRE REQUISITE SET UP

Spin up an EC2 instance

Create an s3 bucket

Spin an instance in RDS

Connet your RDS instance to your MySql workbench.

Set rules in SNS to receive aan email about upload in an S3 bucket.

Set up cloud front

Set ELB for this you need two ec2 instances so that you can balance requests accordingly

Set up cloudwatch for monitoring services.

List of Softwares to download

Download PhpStorm

Download MySql Workbench

Make sure you have an AWS account

Install an SSH client (e.g. Putty)

How to run project locally

So basically you need to coonet your SSH to Putty and save all your files in a single directory. With your ec2 instance connected to your Putty you have to bring your php page locally. After this you need to register a domain and route your traffic from ec2 to registered domain.
