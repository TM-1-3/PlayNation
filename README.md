<img src='https://sigarra.up.pt/feup/pt/imagens/LogotipoSI' width="30%"/>

<div align="center">
🌍 <a href="README.md">English</a> | 🇵🇹 <a href="README.pt.md">Português</a>
</div>

<h3 align="center">BSc in Informatics and Computing Engineering<br> L.EIC023 - Database and Web Applications Laboratory<br> 2025/2026 </h3>

---
<h3 align="center"> Collaborators &#129309 </h2>

<div align="center">

| Name          | Number      |
|---------------|-------------|
| Carolina Ferreira | up202303547 |
| Gabriela Silva | up202304064 |
| João Marques | up202307612 |
| Tomás Morais  | up202304692 |

Grade : 17,6

</div>

# PlayNation

## Project Overview

PlayNation is a web-based social network exclusively dedicated to sports enthusiasts.
This platform is designed to provide users with a personalized space where they can share their fitness lifestyle, follow their favourite modalities, interact with like-minded individuals and actively participate in a vibrant sports community. Additionally, this system might serve as a rich source of fitness knowledge, enabling users to share, discover, learn and explore a wide range of sports-related content while promoting interaction among athletes, fans, teams, coaches and fitness practitioners.
Its main features support this goal by allowing users to post photos, videos, and statements; interact with other users' content through likes, comments, saves, and shares; engage in private chats; and search for specific accounts and content using filters for sports or athletes.
Users are organized into groups with distinct permissions. These groups include Guests who can only view public content; Basic users, the core registered users who can interact, post, and follow; Verified accounts for official updates regarding athletes and teams; and Administrators who manage all users and content to ensure platform integrity.
The platform will be responsive to the different devices used and easy to manage, ensuring a pleasant user experience.

## Product 

### Credentials 

**Regular User:** username: hvegan; password: password

**Admin:** username: admin; password: password

## Authors

Carolina Alves Ferreira, up202303547@edu.fe.up.pt
Gabriela de Mattos Barboza da Silva, up202304064@edu.fe.up.pt
João Pedro Magalhães Marques, up202307612@edu.fe.up.pt
Tomás da Silva Morais, up202304692@edu.fe.up.pt

# ER: Requirements Specification Component


## A1: PlayNation

In the current digital world where general-purpose social media platforms usually present a convoluted experience for users seeking content related to their specific interests, PlayNation is being developed as a web-based social network exclusively dedicated to sports enthusiasts. 

This platform  is designed to provide users with a personalized space where they can share their fitness lifestyle, follow their favourite modalities, interact with like-minded individuals and actively participate in a vibrant sports community. Additionally, this system might serve as a rich source of fitness knowledge, enabling users to share, discover, learn and explore a wide range of sports-related content while promoting interaction among athletes, fans, teams, coaches and fitness practitioners.

Its main features support this goal by allowing users to post photos, videos, and statements; interact with other users' content through likes, comments, saves, and shares; engage in private chats; and search for specific accounts and content using filters for sports or athletes.

Users are organized into groups with distinct permissions. These groups include Guests who can only view public content; Basic users, the core Authenticated users who can interact, post, and follow; Verified accounts for official updates regarding athletes and teams; and Administrators who manage all users and content to ensure platform integrity.

The platform will be responsive to the different devices used and easy to manage, ensuring a pleasant user experience.



---


## A2: Actors and User stories



### 1. Actors

For PlayNation, the actors are represented in Figure 1 and described in Table 1.

<div align="center">
![PlayNationActors](uploads/4024163cef2f811b869f06a3edfef9c0/PlayNationActors.jpeg)

Figure 1: PlayNation actors.
</div>

| Identifier    | Description    |
| ------------- | --------------------------------- |
| User          | Generic user who can view public content (such as posts and comments) and search for accounts. |
| Unauthenticated User (Visitor)      | Unauthenticated user who is limited to viewing public content. They are able to register (sign-up) or login to the system in order to interact with it.|
| Authenticated User    | A Authenticated user who can perform all core social interactions, such as creating posts, commenting, liking, sharing, following other users, and managing their own profile. They are the author of their own posts and comments.|
| Verified User | A Authenticated user that represents official entities like athletes,  teams or content creators. They can post official updates, schedules, and results. Their role is marked by a verification badge, and they are the author of official announcements.|
| Group Owner | A Authenticated user that creates and manages a group, having administrative privileges and actions related to the group and the users who takes part of it.|
| Administrator | An Authenticated user with system-wide privileges for  management and moderation. This actor can manage all user accounts, moderate content (delete any post or comment), and ensure platform integrity, transcending the permissions of standard Authenticated users.|
| OAuth API     | External OAuth API that can be used to register or authenticate into the system using Google account.|
| Gmail API     | External Gmail API used to send emails.|
 
<div align="center">
Table 1: PlayNation actors description. 
</div>

### 2. User Stories

#### 2.1. User
| Identifier   | Name      | Priority    | Responsible        | Description                                           |
| ------------ | --------- | ----------- | ------------------ | ----------------------------------------------------- |
|  US01        | Public Timeline | High | Carolina Ferreira | As a User I want to access a timeline that displays popular public content from all users so that I can stay updated with trending posts. |
|  US02        | View Account | High | João Marques | As a User I want to view a profile, whose content is accessible to me, so that I can easily have access to its publications and details. |
|  US03        | Search Account | High | Gabriela Mattos | As a User I want to search for accounts so that I can directly view their content, if it is accessible to me. |
|  US04        | View Post | High | Carolina Ferreira | As a User I want to view a post, if accessible to me, so that I can fully understand its content, context, and any associated information. |
|  US05        | Search Post | High | Gabriela Mattos | As a User I want to search for posts using keywords related to their content so that I can quickly find and view posts that are most relevant to my interests. |
|  US06        | View Comments on Post | High | Carolina Ferreira | As a User I want to view the comments on a post so that I can understand other users’ opinions and perspectives about that publication. |
|  US07        | View Likes on Post | High | Carolina Ferreira | As a Authenticated User I want to view the number of likes on a post as well as the account who liked it so that I can understand its engagement. |
|  US08        | Exact Match Search | High | Gabriela Mattos |  As a User I want to search for the exact name of the desired content, so that only that one appears. |
|  US09        | Text Search | High | Gabriela Mattos |  As a User I want to search using text so that all content that relates to it appears in the results. |
|  US10        | Filter Search | High | Gabriela Mattos | As a User I want to filter my search of accounts, groups or posts to specific categories, such as modalities, teams, dates or number of likes, so that only specific content is returned. |
|  US11        | Product Information | High | João Marques |  As a User I want to access information about the application, such as a general description, an overview of its main features and the contacts of the creators, so that I can better understand the purpose of the app, its functionality, and how to reach the development team if needed. |
|  US12        | Contextual Information and Tips | High | Gabriela Mattos |  As a User I want to receive tips related to the actions of UI artifacts, such as placeholders in form inputs that indicate what should be entered or hints that appear when hovering over buttons, so that I can better understand how to interact with the interface and use the application more effectively. |
|  US13        | Contextual Error Messages | High | Gabriela Mattos |  As a User I want to receive a message whenever an action I tried to perform cannot be completed, along with an explanation of why it failed so that I can understand what went wrong and take the appropriate steps to fix it or try again or if I am locked from performing a specific action. |
|  US14        | Search  Comments on Post | Medium | Gabriela Mattos | As a User I want to filter comments on a post by the author, number of likes, or publication date, so that I can customize how the comments are presented to me. |

<div align="center">
Table 2: User user stories. 
</div>

#### 2.2. Unauthenticated User

| Identifier   | Name      | Priority    | Responsible        | Description                                           |
| ------------ | --------- | ----------- | ------------------ | ----------------------------------------------------- |
|  US15        | Sign-up | High | Tomás Morais | As an Unauthenticated User I want to create an account so that, when logged in, I can access all the functionalities of a Authenticated user. |
|  US16        | Sign-in | High | Tomás Morais | As an Unauthenticated User I want to log in into an existing account so that I can experience the social network as a Authenticated user. |
|  US17        | Recover Password | High | Tomás Morais |  As an Unauthenticated User I want to recover my password, in case I forgot it, so that I can successfully sign in the system. |
|  US18        | Visitor Only Access | High | Tomás Morais | As an Unauthenticated User I want to be able to access the social network without registration so that I am only able to access the functionalities of an unAuthenticated user. |
|  US19        | OAuth API Sign-up | Low | Tomás Morais | As an Unauthenticated User, I want to sign up using my Google account so that I can quickly create an account without going through a full manual registration process. |
|  US20        | OAuth API Sign-in | Low | Tomás Morais | As an Unauthenticated User, I want to log in using my Google account so that I can easily authenticate and access the system. |

<div align="center">
Table 3: Unauthenticated User user stories. 
</div>

#### 2.3. Autheticated User

| Identifier   | Name      | Priority    | Responsible        | Description                                           |
| ------------ | --------- | ----------- | ------------------ | ----------------------------------------------------- |
|  US21        | Profile Visibility | High | Tomás Morais | As an Autheticated User I want to make my profile public or private so that only my friends can access its content. |
|  US22        | Logout | High | Tomás Morais | As an Authenticated User I want to logout so that I can use the system merely as a visitor. |
|  US23        | Delete Account | High | Tomás Morais | As an Authenticated User I want to delete my account so that I can remove an unused account from the system. |
|  US24        | Upload/Update Profile Picture | High | Tomás Morais | As an Authenticated User I want to add or change my profile picture so that I can personalize my profile and make it easier for others to recognize me. |
|  US25        | Edit Profile | High | Tomás Morais | As an Authenticated User I want to edit my profile so that I can change its information, visibility and details as needed and keep it updated. |
|  US26        | Personalized Timeline | High | Carolina Ferreira | As an Authenticated User I want to access a personalized timeline that shows posts from accounts I’m friends with and content related to my interests so that I can engage with what is most relevant to me. |
|  US27        | Create Post | High | Carolina Ferreira | As an Authenticated User I want to publish a photo, video or statement in the form of a post so that I can share my thoughts, experiences, and interests with others on the platform. |
|  US28        | Add Caption to Post | High | Carolina Ferreira | As an Authenticated User I want to be able to add a caption to my post so that I can complement it with descriptive text or context. |
|  US29        | Edit Post | High | Carolina Ferreira | As an Authenticated User I want to edit my own posts so that I can update or refine their content for other users to see. |
|  US30        | Delete Post | High | Carolina Ferreira | As an Authenticated User I want to delete my own publications so that it is permanently removed from the social network and no longer visible to other users. |
|  US31        | Like Post | High | Carolina Ferreira | As an Authenticated User I want to like a post so that I can show my appreciation and support for its content. |
|  US32        | Report Post | High | Gabriela Mattos | As an Authenticated User I want to report a post so that I can alert the administrators about inappropriate or harmful content. |
|  US33        | Comment on Post | High | Carolina Ferreira | As an Authenticated User I want to leave a public comment on a post so that I can share my opinion and thoughts about its content. |
|  US34        | Edit Comment | High | Carolina Ferreira | As an Authenticated User I want to edit my comment so that I can update or refine its content for other users to see. |
|  US35        | Delete Comment | High | Carolina Ferreira | As an Authenticated User I want to delete a previously published comment on a post I own so that I can remove content that I no longer want to appear on the platform. |
|  US36        | Report Comment | High | Gabriela Mattos | As an Authenticated User I want to report a user’s comment so that I can alert the administrators for harmful, hateful or inappropriate content on the platform. |
|  US37        | Send Friend Request | High | João Marques | As an Authenticated User I want to send a friend request to another profile so that I can connect and interact with that user. |
|  US38        | Manage Received Friend Requests | High | João Marques | As an Authenticated User I want to accept or deny received friend requests from other users so that I can control who connects with me on the platform. |
|  US39        | View Friends List | High | João Marques | As an Authenticated User I want to view which profiles I am friends with so that I can manage my connections in the platform. |
|  US40        | Report Profile | High | Gabriela Mattos | As an Authenticated User I want to report a profile so that I can alert the administrators about inappropriate or harmful content. |
|  US41        | View Group | High | João Marques | As an User I want to view a group, which I’m a member of, so that I can have access to its content and any associated information. |
|  US42        | Search Group | High | João Marques | As an User I want to search for public groups so that I can access their content. |
|  US43        | Leave Group | High | João Marques | As an Authenticated User I want to leave a group so that I stop being one of its members. |
|  US44        | Post on Group | High | João Marques | As an Authenticated User I want to share content to a group I am member of so that I can contribute to interactions and engage with the other members. |
|  US45        | Create Group | High | João Marques | As an Authenticated User I want to create a group so that users can interact and share content related to a specific topic. |
|  US46        | Report Group | High | Gabriela Mattos | As an Authenticated User I want to report a group so that I can alert the administrators for harmful, hateful or inappropriate content on the platform. |
|  US47        | Friend Request Notification | High | Gabriela Mattos | As an Authenticated User I want to receive a notification whenever a user sends me a friend request so that I can rapidly accept or deny it. |
|  US48        | Like Post Notification | High | Gabriela Mattos | As an Authenticated User I want to receive a notification whenever an user likes one of my posts so that I can stay informed about the engagement on my content. |
|  US49        | Comment Post Notification | High | Gabriela Mattos | As an Authenticated User I want to receive a notification whenever an user comments on one of my posts so that I can stay informed about thoughts and opinions to its content. |
|  US50        | Friend Request Acceptance Notification | High | Gabriela Mattos | As an Authenticated User I want to receive a notification whenever a friend request I sent is accepted so that I know I am now a friend of that user. |
|  US51        | Group Join Acceptance Notification | High | Gabriela Mattos | As an Authenticated User I want to receive a notification whenever a group join request I sent i accepted so that I know I am now a member of that group. |
|  US52        | Group Post Notification | High | Gabriela Mattos | As an Authenticated User I want to receive a notification whenever a post is made on a group I’m a member of so that I can stay updated on new content and discussions. |
|  US57        | Mark Notifications as Read | High | Gabriela Mattos | As an Authenticated User I want to mark the notifications I receive as read so that I can keep track of what events I already seen or treated. |
|  US58        | List of Interested Topics | Medium | Carolina Ferreira | As an Authenticated User I want to manage a list of topics I am interested in, such as modalities or teams, so that the social network can recommend content that is most relevant to me. |
|  US59        | Add Topic to Post | Medium | Carolina Ferreira | As an Authenticated User I want to associate topics to a post so that other users can easily find them through search or receive them as recommendations if they have such topic as one of their interest. |
|  US60        | Save Post | Medium | Carolina Ferreira | As an Authenticated User I want to save other users’ posts so that I can easily access and view them later. |
|  US61        | Manage Saved Posts | Medium | Carolina Ferreira | As an Authenticated User I want to manage a list of my saved posts so that I can organize, view or remove them as needed. |
|  US62        | Share Post | Medium | Carolina Ferreira | As an Authenticated User I want to send posts to other users or groups so that I can directly share them with anyone. |
|  US63        | Remove Friend | Medium | João Marques | As an Authenticated User I want to remove a profile from my friends list so that I can eliminate unwanted connections. |
|  US64        | Send Message to Friend | Medium | João Marques | As an Authenticated User I want to send a private message to a friend so that I can communicate directly with them and maintain our connection. |
|  US65        | View Conversations with Friends | Medium | João Marques | As an Authenticated User I want to view all my current conversations with friends so that I can easily access and continue my ongoing chats. |
|  US66        | Add User to Group | Medium | João Marques | As an Authenticated User I want to send a request for a user to join my group so that I can add specific users to it. |
|  US67        | Private Message Notification | Medium | Gabriela Mattos | As an Authenticated User I want to receive a notification whenever a friend sends me a private message so that I don’t miss a conversation. |
|  US68        | View Notifications | Medium | Gabriela Mattos | As an Authenticated User I want to view all notifications I received so that I keep track of pending requests or interactions relevant to me. |
|  US69        | Tag Account on Post | Low | Carolina Ferreira | As an Authenticated User I want to tag other profiles on a post so that I can reference users who are related to that publication. |
|  US70        | Like Comment | Low | Carolina Ferreira | As an Authenticated User I want to like another user’s comment so that I can show my agreement or appreciation for their opinion. |
|  US71        | Block Profile | Low | João Marques | As an Authenticated User I want to block a user so that the profile and posts of one become invisible to another and interactions become impossible. |
|  US72        | Like Comment Notification | Low | Gabriela Mattos | As an Authenticated User I want to receive a notification whenever an user likes one of my comments so that I can stay informed about the reception of it. |
|  US73        | Tagged on Post Notification | Low | Gabriela Mattos | As an Authenticated User I want to receive a notification whenever an user tags me on a post or comment so that I am aware of posts or interactions involving me. |
|  US74        | Gmail API Notifications | Low | Gabriela Mattos | As an Authenticated User I want to receive important notifications via email so that I stay informed even when I’m not using the platform. |

<div align="center">
Table 4: Authenticated User user stories. 
</div>

#### 2.4. Verified User

| Identifier   | Name      | Priority    | Responsible        | Description                                           |
| ------------ | --------- | ----------- | ------------------ | ----------------------------------------------------- |
|  US75        | Verification Badge | High | Tomás Morais | As a Verified User, I want to have a visible badge on my profile and posts so that users can immediately identify my account as authentic and official. |
|  US76        | Enhanced Comment Moderation | Low | Tomás Morais | As a Verified User, I want to automatically hide comments containing specific keywords I define and disable comments on old posts so that I can efficiently manage harassment and maintain a positive community space. |

<div align="center">
Table 5: Verified User user stories. 
</div>

#### 2.5. Group Owner

| Identifier   | Name      | Priority    | Responsible        | Description                                           |
| ------------ | --------- | ----------- | ------------------ | ----------------------------------------------------- |
|  US77        | Group Visibility | High | João Marques | As a Group Owner I want to define the visibility of a group I created as public or private so that only the users I define can become members of my private group. |
|  US78        | Remove User from Group | High | João Marques | As a Group Owner I want to directly remove an user from a group so that I can manage membership and maintain a suitable group environment. |
|  US79        | Manage Group Entering Requests | High | João Marques | As a Group Owner I want to accept or deny requests from other users to join a public group I created so that I can control who becomes a member. |
|  US80        | Edit Group | High | João Marques | As a Group Owner I want to edit the properties of a group I created so that I can update its information or visibility as needed. |
|  US81        | Join Group Request Notification | High | Gabriela Mattos | As a Group Owner I want to receive a notification whenever an user asks to join a public group I created so that I can rapidly accept or deny their entry. |

<div align="center">
Table 6: Group Owner user stories. 
</div>

#### 2.6. Administrator

| Identifier   | Name      | Priority    | Responsible        | Description                                           |
| ------------ | --------- | ----------- | ------------------ | ----------------------------------------------------- |
|  US82        | Manage Reported Content | High        | Gabriela Mattos |   As an Administrator I want to access user’s reported content so that I can evaluate whether it should be removed or maintained on the platform. |
|  US83        | Remove Content | High      | Gabriela Mattos | As an Administrator I want to remove a post or comment from the platform so that I can moderate and maintain a safe and appropriate community environment. |
|  US84        | Ban User | High         | Gabriela Mattos | As an Administrator I want to ban an account from the platform so that I can eliminate those who do not contribute to a safe and respectful community environment. |
|  US85       | Block User | High         | João Marques | As an Administrator I want to block an user so that they become unable to use the system without removing its account. |
|  US86        | Unblock User | High         | João Marques | As an Administrator I want to unblock a blocked user so that they can use the system as an Authenticated user again. |
|  US87        | Moderate Groups | High         | Gabriela Mattos | As an Administrator I want to be able to remove groups or abusive members in order to maintain a respectful community environment. |
| US88                | Administer User Accounts | High | Gabriela de Mattos | As an Administrator I want to be able to view, edit, delete and create a user account. |

<div align="center">
Table 7: Administrator user stories. 
</div>

### 3. Supplementary Requirements

#### 3.1. Business rules

| Identifier | Name          | Description    |
| ---------- | ------------- | ----------------------------------------------------------------------------------------------------------------------------------------|
| BR01 | Profile Visibility | Profiles can be public or private, but the content of private profiles can only be accessed by their friends. |
| BR02 | Group Visibility | Groups can be public or private, but private ones are only visible to their members. | 
| BR03 | Community Guidelines | Content that is disrespectful, insulting, or promotes violence, hate or prejudice is strictly prohibited. Such content may be removed, and in severe cases, the account responsible may face a permanent ban. |
| BR04 | Account Deletion | Upon account deletion, shared user data (e.g. comments, reviews, likes) is kept but is made anonymous. |
| BR05 | Self-Interaction | Users are permitted to comment, like, share and save their own content. | 
|BR06 | Date Validation | All user-provided dates in the system must be a current or past date. |

<div align="center">
Table 8: PlayNation business rules. 
</div>

#### 3.2. Technical requirements

| Identifier | Name          | Description    |
| ---------- | ------------- | ----------------------------------------------------------------------------------------------------------------------------------------|
| TR01       | Accessibility | The system must ensure that everyone can access the pages, regardless of whether they have any handicap or not, or the Web browser they use. |
| TR02       | Security      | The system must store user passwords securely. |
| TR03       | Scalability   | The system must handle growth in the number of concurrent users and their interactions, particularly during major sporting events.|
| TR04       | Database      | The PostgreSQL database management system must be used for data persistence. |
| TR05       | Portability   | The server-side system must be platform-independent and capable of running on mainstream operating systems (e.g., Linux, Windows, MacOS).|
| TR06       | Ethics        | The system must meet ethical principles in software development. Personal user data shall not be collected or shared without the user's explicit, informed consent.|
| TR07       | Usability     | The system must be simple and intuitive to use, requiring no prior training.|
| TR08       | Performance   | The system must render pages and process user interactions with an average response time of under 2 seconds.|
| TR09       | Robustness | The system must be prepared to handle and continue operating when runtime errors occur. |

<div align="center">
Table 9: PLayNation technical requirements. 
</div>

#### 3.3. Restrictions

| Identifier | Name          | Description    |
| ---------- | ------------- | ----------------------------------------------------------------------------------------------------------------------------------------|
| R01 | Database | The database should use PostgreSQL |

---


## A3: Information Architecture




### 1. Sitemap

The PlayNation platform is organized into four main sections: the Static Pages, including general information and settings such as Contact Us, About/Services, and Settings; the User Pages, where users can manage their profiles, posts, friends, groups, messages, and notifications; the Item Pages, which allow users to view profiles, posts, comments, and categories/tags; and the Admin Pages, dedicated to administration tasks such as User Management, Content Moderation, and Verification Requests. All sections are interconnected through the Homepage, which serves as the central hub of navigation within the system.

<div align="center">
![image](uploads/6a5407bb77941e0f99f03c6bde82a2b0/image.png)

Figure 1: PlayNation sitemap.
</div>


### 2. Wireframes

In relation to the PlayNation Social Network, the two figures below, 2 and 3, represent the wireframes for the Homepage (UI00) and the Create Post Page (UI16), respectively.

<div align="center">
![image](uploads/7d17e24a6fb501e4d0df9ddacd0f1017/image.png)

Figure 2: Homepage (UI00) wireframe.
</div>

<div align="center">
![image](uploads/f740b3efb383707e68e81eb06e3b180c/image.png)

Figure 3: Create Post (UI16) wireframe.
</div>


---

