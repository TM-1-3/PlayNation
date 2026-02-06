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

# PlayNation Report

- [Project Overview](#project-overview)
  - [Credentials for Testing](#credentials)
  - [Authors](#authors)
- [ER: Requirements Specification Component](#er)
  - [A1: PlayNation](#a1)
  - [A2: Actors and User Stories](#a2)
    - [1. Actors](#actors)
    - [2. User Stories](#us)
       - [2.1. User](#2.1)
       - [2.2. Unauthenticated User](#2.2)
       - [2.3. Authenticated User](#2.3)
       - [2.4. Verified User](#2.4)
       - [2.5. Group Owner](#2.5)
       - [2.6. Administrator](#2.6)
    - [3. Supplementary Requirements](#3)
       - [3.1. Business Rules](#3.1)
       - [3.2. Technical Requirements](#3.2)
       - [3.3. Restrictions](#3.3)
  - [A3: Information Architecture](#a3)
    - [1. Sitemap](#a31)
    - [2. Wireframes](#a32)


<a id="project-overview"></a>
## Project Overview

PlayNation is a web-based social network exclusively dedicated to sports enthusiasts.
This platform is designed to provide users with a personalized space where they can share their fitness lifestyle, follow their favourite modalities, interact with like-minded individuals and actively participate in a vibrant sports community. Additionally, this system might serve as a rich source of fitness knowledge, enabling users to share, discover, learn and explore a wide range of sports-related content while promoting interaction among athletes, fans, teams, coaches and fitness practitioners.
Its main features support this goal by allowing users to post photos, videos, and statements; interact with other users' content through likes, comments, saves, and shares; engage in private chats; and search for specific accounts and content using filters for sports or athletes.
Users are organized into groups with distinct permissions. These groups include Guests who can only view public content; Basic users, the core registered users who can interact, post, and follow; Verified accounts for official updates regarding athletes and teams; and Administrators who manage all users and content to ensure platform integrity.
The platform will be responsive to the different devices used and easy to manage, ensuring a pleasant user experience.

<a id="credentials"></a>
### Credentials for Testing

**Regular User:** username: hvegan; password: password

**Admin:** username: admin; password: password

<a id="authors"></a>
### Authors

**Carolina Alves Ferreira**, up202303547@edu.fe.up.pt

**Gabriela de Mattos Barboza da Silva**, up202304064@edu.fe.up.pt

**João Pedro Magalhães Marques**, up202307612@edu.fe.up.pt

**Tomás da Silva Morais**, up202304692@edu.fe.up.pt

<a id="er"></a>
## ER: Requirements Specification Component


<a id="a1"></a>
### A1: PlayNation

In the current digital world where general-purpose social media platforms usually present a convoluted experience for users seeking content related to their specific interests, PlayNation is being developed as a web-based social network exclusively dedicated to sports enthusiasts. 

This platform  is designed to provide users with a personalized space where they can share their fitness lifestyle, follow their favourite modalities, interact with like-minded individuals and actively participate in a vibrant sports community. Additionally, this system might serve as a rich source of fitness knowledge, enabling users to share, discover, learn and explore a wide range of sports-related content while promoting interaction among athletes, fans, teams, coaches and fitness practitioners.

Its main features support this goal by allowing users to post photos, videos, and statements; interact with other users' content through likes, comments, saves, and shares; engage in private chats; and search for specific accounts and content using filters for sports or athletes.

Users are organized into groups with distinct permissions. These groups include Guests who can only view public content; Basic users, the core Authenticated users who can interact, post, and follow; Verified accounts for official updates regarding athletes and teams; and Administrators who manage all users and content to ensure platform integrity.

The platform will be responsive to the different devices used and easy to manage, ensuring a pleasant user experience.



---

<a id="a2"></a>
### A2: Actors and User stories


<a id="actors"></a>
#### 1. Actors

For PlayNation, the actors are represented in Figure 1 and described in Table 1.

<div align="center">
<img width="764" height="675" alt="image" src="https://github.com/user-attachments/assets/23e4dbdb-0d69-4f55-b745-f2720b37f751" />


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

<a id="us"></a>
#### 2. User Stories

<a id="2.1"></a>
##### 2.1. User
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

<a id="2.2"></a>
##### 2.2. Unauthenticated User

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

<a id="2.3"></a>
##### 2.3. Autheticated User

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

<a id="2.4"></a>
##### 2.4. Verified User

| Identifier   | Name      | Priority    | Responsible        | Description                                           |
| ------------ | --------- | ----------- | ------------------ | ----------------------------------------------------- |
|  US75        | Verification Badge | High | Tomás Morais | As a Verified User, I want to have a visible badge on my profile and posts so that users can immediately identify my account as authentic and official. |
|  US76        | Enhanced Comment Moderation | Low | Tomás Morais | As a Verified User, I want to automatically hide comments containing specific keywords I define and disable comments on old posts so that I can efficiently manage harassment and maintain a positive community space. |

<div align="center">
Table 5: Verified User user stories. 
</div>

<a id="2.5"></a>
##### 2.5. Group Owner

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

<a id="2.6"></a>
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

<a id="3"></a>
#### 3. Supplementary Requirements

<a id="3.1"></a>
##### 3.1. Business rules

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

<a id="3.2"></a>
##### 3.2. Technical requirements

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

<a id="3.3"></a>
##### 3.3. Restrictions

| Identifier | Name          | Description    |
| ---------- | ------------- | ----------------------------------------------------------------------------------------------------------------------------------------|
| R01 | Database | The database should use PostgreSQL |

---


<a id="a3"></a>
### A3: Information Architecture



<a id="a31"></a>
#### 1. Sitemap

The PlayNation platform is organized into four main sections: the Static Pages, including general information and settings such as Contact Us, About/Services, and Settings; the User Pages, where users can manage their profiles, posts, friends, groups, messages, and notifications; the Item Pages, which allow users to view profiles, posts, comments, and categories/tags; and the Admin Pages, dedicated to administration tasks such as User Management, Content Moderation, and Verification Requests. All sections are interconnected through the Homepage, which serves as the central hub of navigation within the system.

<div align="center">
<img width="787" height="510" alt="image" src="https://github.com/user-attachments/assets/c37ec133-e581-4c3a-aa1f-efd5938455de" />


Figure 1: PlayNation sitemap.
</div>

<a id="a32"></a>
#### 2. Wireframes

In relation to the PlayNation Social Network, the two figures below, 2 and 3, represent the wireframes for the Homepage (UI00) and the Create Post Page (UI16), respectively.

<div align="center">
<img width="799" height="360" alt="image" src="https://github.com/user-attachments/assets/e52d108b-fd75-44b3-ad4c-2e51905cc495" />


Figure 2: Homepage (UI00) wireframe.
</div>

<div align="center">
<img width="799" height="360" alt="image" src="https://github.com/user-attachments/assets/46e56f76-767b-478c-8ea3-f94655c26e11" />


Figure 3: Create Post (UI16) wireframe.
</div>


---

<a id="ebd"></a>
## EBD: Database Specification Component

<a id="a4"></a>
### A4: Conceptual Data Model

The Conceptual Data Model for the PlayNation social network includes and describes the relevant entities and the relationships between them that are important for the database specification, using UML.

<a id="a41"></a>
#### 1. Class diagram

The UML diagram below represents the main organizational entities, the relationships between them and the respective multiplicities, domains and attributes, as well as the respective types and constraints, for the **PlayNation** Social Network Platform.

<div align="center">
<img width="1087" height="770" alt="image" src="https://github.com/user-attachments/assets/2c6eb162-f42c-432f-88aa-f0f4001e9096" />


Figure 1: PlayNation Conceptual Data in UML
</div>

<a id="a42"></a>
#### 2. Additional Business Rules

The table below identifies and describes additional business rules and restrictions that cannot be conveyed in the UML class diagram.

| Identifier | Name          | Description    |
| ---------- | ------------- | ----------------------------------------------------------------------------------------------------------------------------------------|
| BR07 | Group Join Restriction | A user cannot request to join a group that he/she is already a part of. |
| BR08 | Self-Friending Prohibition | A user cannot be friends with themselves. | 
| BR09 | Self-Request Prohibition | A user cannot request to be friends with themselves. |
| BR10 | Existing Friend Request Prohibition | A user cannot request to be friends with a user that he/she already is friends with. |
| BR11 | Group Owner Membership | A group owner is also a member of your group. | 
| BR12 | Post Interaction Access | A user can only comment/like on posts from public users, posts from users they are friends with or on posts from groups to which they belong. |
| BR13 | Group Post Membership Required | A user can only post to a group that they belong to. | 
| BR14 | Single Like Constraint | A user can only like a comment/post once. | 
| BR15 | Post Content Requirement | Posts must have either a description or an image (or both). |

<div align="center">

Table 1: Additional business rules
</div> 

---

<a id="a5"></a>
### A5: Relational Schema, validation and schema refinement

The A5 Artifact presents the database relational schema derived from the corresponding conceptual data model, as well as its validation and sequential normalization.

<a id="a51"></a>
#### 1. Relational Schema

The following table presents the relational schema obtained from the UML, including attributes, domains, primary and foreign keys and constraints for each tuple.

| Relation reference | Relation Compact Notation                        |
| ------------------ | ------------------------------------------------ |
| R01 | registered_user (<ins>id_user</ins>, username **UK** **NN**, name **NN**, email **UK** **NN**, password **NN**, biography, profile_picture **DF** TRUE) |
| R02 | administrator(<ins>id_admin</ins> → registered_user) |
| R03 | verified_user(<ins>id_verified</ins> → registered_user) |
| R04 | group_owner(<ins>id_group_owner</ins> → registered_user) |
| R05 | user_friend(id_user → registered_user **NN***, id_friend → registered_user **NN**, (<ins>id_user</ins>,<ins>id_friend</ins>)) |
| R06 | user_friend_request(id_user → registered_user **NN**, id_requester → registered_user **NN**, (<ins>id_user</ins>,<ins>id_requester</ins>)) |
| R07 | label(<ins>id_label</ins>, designation **NN**, image **NN**) |
| R08 | sport(<ins>id_sport</ins> → label) |
| R09 | category(<ins>id_sport</ins> → label) |
| R10 | user_label(id_user → registered_user **NN**, id_label → label **NN**, (<ins>id_user</ins>,<ins> id_label</ins>)) |
| R11 | post(<ins>id_post</ins>, id_creator → registered_user **NN**, image, description, date **NN** **CK** date<=now()) |
| R12 | post_label(id_post → post **NN**, id_label → label **NN**, (<ins>id_post</ins>, <ins>id_label</ins>)) |
| R13 | post_like(id_post → post **NN**, id_user → registered_user **NN**, (<ins>id_post</ins>, <ins>id_user</ins>)) |
| R14 | post_save(id_post → post **NN**, id_user → registered_user **NN**, (<ins>id_post</ins>, <ins>id_user</ins>)) |
| R15 | comments(<ins>id_comment</ins>, id_post → post **NN**, id_user → registered_user **NN**, id_reply → comments **NN**, text **NN**, date **NN** **CK** date<=now()) |
| R16 | comment_like(id_comment → comment **NN**, id_user → registered_user **NN**, (<ins>id_comment</ins>, <ins>id_user</ins>)) |
| R17 | groups(<ins>id_group</ins>, id_owner → group_owner **NN**, name **UK** **NN**, description, picture, is_public **DF** TRUE) |
| R18 | group_membership(id_group → group **NN**, id_member → registered_user **NN**, (<ins>id_group</ins>, <ins>id_member</ins>)) |
| R19 | group_join_request(id_group → group **NN**, id_requester → registered_user **NN**, (<ins>id_group</ins>, <ins>id_requester</ins>)) |
| R20 | message(<ins>id_message</ins>, text **NN**, image, date **NN** **CK** date<=now()) |
| R21 | private_message(<ins>id_message</ins> → message, id_sender → registered_user **NN**, id_receiver → registered_user **NN**) |
| R22 | group_message(<ins>id_message</ins> → message, id_group → groups **NN**, id_sender → registered_user **NN**) |
| R23 | report(<ins>id_report</ins>, description **NN**)|
| R24 | report_post(id_report → report **NN**, id_post → post **NN**, (<ins>id_report</ins>, <ins>id_post</ins>)) |
| R25 | report_group(id_report → report **NN**, id_group → groups **NN**, (<ins>id_report</ins>, <ins>id_group</ins>)) |
| R26 | report_user(id_report → report **NN**, id_user → registered_user **NN**, (<ins>id_report</ins>, <ins>registered_user</ins>)) |
| R27 | report_comment(id_report → report **NN**, id_comment → comments **NN**, (<ins>id_report</ins>, <ins>id_comment</ins>)) |
| R28 | notification(<ins>id_notification</ins>, id_receiver → registered_user **NN**, id_emitter → registered_user **NN**, text **NN**, date **NN** **CK** date<=now()|
| R29 | friend_request_notification(<ins>id_notification</ins> → notification, accepted) |
| R30 | friend_request_result_notification(<ins>id_notification</ins> → notification) |
| R31 | like_post_notification(<ins>id_notification</ins> → notification, id_post → post **NN**) |
| R32 | comment_notification(<ins>id_notification</ins> → notification, id_comment → comment **NN**) |
| R33 | like_comment_notification(<ins>id_notification</ins> → notification, id_comment → comment **NN**) |
| R34 | private_message_notification(<ins>id_notification</ins> → notification, id_message → message **NN**) |
| R35 | group_message_notification(<ins>id_notification</ins> → notification, id_message → message **NN**) |
| R36 | join_group_request_notification(<ins>id_notification</ins> → notification, id_group → groups **NN**, accepted) |
| R37 | join_group_request_result_notification(<ins>id_notification</ins> → notification, id_group → groups **NN**) |
| R38 | user_block(id_user → registered_user **NN**, id_blocked → registered_user **NN**, (<ins>id_user</ins>,<ins>id_blocked</ins>)) |
| R39 | user_tag(id_post → post **NN**, id_user → registered_user **NN**, (<ins>id_post</ins>, <ins>id_user</ins>) |
| R40 | admin_block(id_admin → administrator **NN**, id_user → registered_user **NN**, (<ins>id_admin</ins>, <ins>id_user</ins>) |
| R41 | admin_ban(id_admin → administrator **NN**, id_user → registered_user **NN**, (<ins>id_admin</ins>, <ins>id_user</ins>) |

<div align="center">

Table 2: PlayNation Relational Schema
</div> 

The relational schemas are documented using a compact notation where constraints  are abbreviated: 
- UK = UNIQUE KEY
- NN = NOT NULL
- DF = DEFAULT
- CK = CHECK  


<a id="a52"></a>
#### 2. Domains

Specification of additional domains.

| Domain Name | Domain Specification           |
| ----------- | ------------------------------ |
| now	      | Current date and time (equivellent to CURRENT_TIMESTAMP in SQL) |

<div align="center">

Table 3: PlayNation Domains
</div>

<a id="a53"></a>
#### 3. Schema validation 

For the schema validation, all functional dependencies were identified and the normalization of all relation schemas was performed.

| **TABLE R01**   | registered_user               |
| --------------  | ---                |
| **Keys**        | { id_user, username, email }         |
| **Functional Dependencies:** |       |
| FD0101          | id_user → { username, name, email, password, biography, profile_picture, is_public } |
| FD0102          | username → { id_user, name, email, password, biography, profile_picture, is_public } |
| FD0103          | email → { id_user, username, name, password, biography, profile_picture, is_public } |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 4: registered_user schema validation
</div>

| **TABLE R02**   | administrator              |
| --------------  | ---                |
| **Keys**        | { id_admin }         |
| **Functional Dependencies:** |    none   |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 5: administrator schema validation
</div>

| **TABLE R03**   | verified_user              |
| --------------  | ---                |
| **Keys**        | { id_verified }         |
| **Functional Dependencies:** |    none   |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 6: verified_user schema validation
</div>

| **TABLE R04**   | group_owner              |
| --------------  | ---                |
| **Keys**        | { id_group_owner }         |
| **Functional Dependencies:** |    none   |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 7: group_owner schema validation
</div>

| **TABLE R05**   | user_friend             |
| --------------  | ---                |
| **Keys**        | { id_user, id_friend }         |
| **Functional Dependencies:** |   none    |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 8: user_friend schema validation
</div>

| **TABLE R06**   | user_friend_request            |
| --------------  | ---                |
| **Keys**        | { id_user, id_requester }         |
| **Functional Dependencies:** |   none   |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 9: user_friend_request schema validation
</div>

| **TABLE R07**   | label               |
| --------------  | ---                |
| **Keys**        | { id_label }         |
| **Functional Dependencies:** |       |
| FD0701          | id_label → { designation, image } |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 10: label schema validation
</div>

| **TABLE R08**   | sport              |
| --------------  | ---                |
| **Keys**        | { id_sport }         |
| **Functional Dependencies:** |    none   |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 11: sport schema validation
</div>

| **TABLE R09**   | category             |
| --------------  | ---                |
| **Keys**        | { id_category }         |
| **Functional Dependencies:** |    none   |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 12: category schema validation
</div>

| **TABLE R10**   | user_label           |
| --------------  | ---                |
| **Keys**        | { id_user, id_label }         |
| **Functional Dependencies:** |    none   |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 13: user_label schema validation
</div>

| **TABLE R11**   | post             |
| --------------  | ---                |
| **Keys**        | { id_post }         |
| **Functional Dependencies:** |       |
| FD1101          | id_post → { image, description, date, creator } |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 14: post schema validation
</div>

| **TABLE R12**   | post_label           |
| --------------  | ---                |
| **Keys**        | { id_post, id_label }         |
| **Functional Dependencies:** |  none   |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 15: post_label schema validation
</div>

| **TABLE R13**   | post_like           |
| --------------  | ---                |
| **Keys**        | { id_post, id_user }         |
| **Functional Dependencies:** |  none  |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 16: post_like schema validation
</div>

| **TABLE R14**   | post_save           |
| --------------  | ---                |
| **Keys**        | { id_post, id_user }         |
| **Functional Dependencies:** |   none   |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 17: post_save schema validation
</div>

| **TABLE R15**   | comments             |
| --------------  | ---                |
| **Keys**        | { id_comment }         |
| **Functional Dependencies:** |       |
| FD1501          | id_comment → { text, date, post, user } |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 18: comments schema validation
</div>

| **TABLE R16**   | comment_like           |
| --------------  | ---                |
| **Keys**        | { id_comment, id_user }         |
| **Functional Dependencies:** |  none   |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 19: comment_like schema validation
</div>

| **TABLE R17**   | groups             |
| --------------  | ---                |
| **Keys**        | { id_group, name }         |
| **Functional Dependencies:** |       |
| FD1701          | id_group → { name, description, picture, is_public, owner } |
| FD1702          | name → { id_group, description, picture, is_public, owner } |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 20: groups schema validation
</div>

| **TABLE R18**   | group_membership           |
| --------------  | ---                |
| **Keys**        | { id_group, id_member }         |
| **Functional Dependencies:** |   none   |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 21: group_membership schema validation
</div>

| **TABLE R19**   | group_join_request           |
| --------------  | ---                |
| **Keys**        | { id_group, id_requester }         |
| **Functional Dependencies:** |   none   |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 22: group_join_request schema validation
</div>

| **TABLE R20**   | message             |
| --------------  | ---                |
| **Keys**        | { id_message }         |
| **Functional Dependencies:** |       |
| FD2001          | id_message → { text, date, image } |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 23: message schema validation
</div>

| **TABLE R21**   | private_message            |
| --------------  | ---                |
| **Keys**        | { id_message }         |
| **Functional Dependencies:** |       |
| FD2101          | id_message → { sender, receiver } |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 24: private_message schema validation
</div>

| **TABLE R22**   | group_message            |
| --------------  | ---                |
| **Keys**        | { id_message }         |
| **Functional Dependencies:** |       |
| FD2201          | id_message → { group, sender } |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 25: group_message schema validation
</div>

| **TABLE R23**   | report            |
| --------------  | ---                |
| **Keys**        | { id_report }         |
| **Functional Dependencies:** |       |
| FD2301          | id_report → { description } |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 26: report schema validation
</div>

| **TABLE R24**   | report_post            |
| --------------  | ---                |
| **Keys**        | { id_report }         |
| **Functional Dependencies:** |       |
| FD2401          | id_report → { post } |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 27: report_post schema validation
</div>

| **TABLE R25**   | report_group            |
| --------------  | ---                |
| **Keys**        | { id_report }         |
| **Functional Dependencies:** |       |
| FD2501          | id_report → { group } |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 28: report_group schema validation
</div>

| **TABLE R26**   | report_user            |
| --------------  | ---                |
| **Keys**        | { id_report }         |
| **Functional Dependencies:** |       |
| FD2601          | id_report → { user } |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 29: report_user schema validation
</div>

| **TABLE R27**   | report_comment            |
| --------------  | ---                |
| **Keys**        | { id_report }         |
| **Functional Dependencies:** |       |
| FD2701          | id_report → { comment } |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 30: report_comment schema validation
</div>

| **TABLE R28**   | notification           |
| --------------  | ---                |
| **Keys**        | { id_notification }         |
| **Functional Dependencies:** |       |
| FD2801          | id_notification → { text, date, reciver, emitter, read } |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 31: notification schema validation
</div>

| **TABLE R29**   | friend_request_notification           |
| --------------  | ---                |
| **Keys**        | { id_notification }         |
| **Functional Dependencies:** |       |
| FD2901          | id_notification → { accepted } |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 32: friend_request_notification schema validation
</div>

| **TABLE R30**   | friend_request_result_notification           |
| --------------  | ---                |
| **Keys**        | { id_notification }         |
| **Functional Dependencies:** |    none   |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 33: friend_request_result_notification schema validation
</div>

| **TABLE R31**   | liked_post_notification           |
| --------------  | ---                |
| **Keys**        | { id_notification }         |
| **Functional Dependencies:** |       |
| FD3101          | id_notification → { post } |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 34: liked_post_notification schema validation
</div>

| **TABLE R32**   | comment_notification           |
| --------------  | ---                |
| **Keys**        | { id_notification }         |
| **Functional Dependencies:** |       |
| FD3201          | id_notification → { comment } |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 35: comment_notification schema validation
</div>

| **TABLE R33**   | liked_comment_notification           |
| --------------  | ---                |
| **Keys**        | { id_notification }         |
| **Functional Dependencies:** |       |
| FD3301          | id_notification → { comment } |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 36: liked_comment_notification schema validation
</div>

| **TABLE R34**   | private_message_notification           |
| --------------  | ---                |
| **Keys**        | { id_notification }         |
| **Functional Dependencies:** |       |
| FD3401          | id_notification → { private_message } |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 37: private_message_notification schema validation
</div>

| **TABLE R35**   | group_message_notification           |
| --------------  | ---                |
| **Keys**        | { id_notification }         |
| **Functional Dependencies:** |       |
| FD3501          | id_notification → { group_message } |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 38: group_message_notification schema validation
</div>

| **TABLE R36**   | join_group_request_notification           |
| --------------  | ---                |
| **Keys**        | { id_notification }         |
| **Functional Dependencies:** |       |
| FD3601          | id_notification → { accepted, group } |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 39: join_group_request_notification schema validation
</div>

| **TABLE R37**   | group_join_request_result_notification           |
| --------------  | ---                |
| **Keys**        | { id_notification }         |
| **Functional Dependencies:** |       |
| FD3701          | id_notification → { group } |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 40: group_join_request_result_notification schema validation
</div>

| **TABLE R38**   | user_block           |
| --------------  | ---                |
| **Keys**        | { id_user, id_blocked }         |
| **Functional Dependencies:** |  none   |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 41: user_block schema validation
</div>

| **TABLE R39**   | user_tag           |
| --------------  | ---                |
| **Keys**        | { id_post, id_user }         |
| **Functional Dependencies:** |  none   |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 42: user_tag schema validation
</div>

| **TABLE R40**   | admin_block           |
| --------------  | ---                |
| **Keys**        | { id_admin, id_user }         |
| **Functional Dependencies:** |  none   |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 43: admin_block schema validation
</div>

| **TABLE R41**   | admin_ban           |
| --------------  | ---                |
| **Keys**        | { id_admin, id_user }         |
| **Functional Dependencies:** |  none   |
| **NORMAL FORM** | BCNF               |

<div align="center">

Table 44: admin_ban schema validation
</div>

Since each table in the relational schema satisfies Boyce–Codd Normal Form (BCNF), the entire schema is already fully normalized. Therefore, no additional normalization steps are required.










---

<a id="a6"></a>
### A6: Indexes, triggers, transactions and database population

The A6 Artifact contains the SQL scripts for creating and populating the database that will sustain the PlayNation social network system, as well, as the implementation of data integrity and businness rules enforcement through triggers and the identification and characterization of indexes. In adittion, it includes the transitions required to maintain data consistency following any operations in the database.

<a id="a61"></a>
#### 1. Database Workload
 
| **Relation reference** | **Relation Name** | **Order of magnitude**        | **Estimated growth** |
| ------------------ | ------------- | ------------------------- | -------- |
| R01                | registered_user        | Tens of thousands (10 k) | Hundreds per month |
| R02                | administrator        | Units (1) | Units per year |
| R03                | verified_user        | Hundreds (100) | Dozens per month |
| R04                | group_owner        | Thousands (1k) | Dozens per week |
| R05                | user_friend        | Thousands (1k) | Thousands per month |
| R06                | user_friend_request        | Hundreds (100) | Hundreds per day |
| R07                | label        | Units (1) | Little growth |
| R08                | sport       | Units (1) | Little growth |
| R09                | category        | Units (1) | Little growth |
| R10                | user_label        | Hundreds (100) | Hundreds per week |
| R11                | post        | Tens of thousands (10k) | Thousands per day |
| R12                | post_label       | Thousands (1k) | Thousands per day |
| R13                | post_like        | Thousands (1k) | Thousands per day |
| R14                | post_save        | Hundreds (100) | Hundreds per day |
| R15                | comment        | Tens of thousands (10 k) | Thousands per day |
| R16                | comment_like        | Thousands (1k) | Thousands per day |
| R17                | group        | Thousands (1k) | Dozens per day |
| R18                | group_membership        | Hundreds (100) | Hundreds per day |
| R19                | group_join_request        | Hundreds (100) | Hundreds per week |
| R20                | message        | Tens of thousands (10 k) | Thousands per day |
| R21                | private_message        | Thousands (1k) |Hundreds per day |
| R22                | group_message        | Tens of thousands (10 k) | Hundreds per day |
| R23                | report       | Hundreds (100) | Hundreds per month |
| R24                | report_post       | Dozens (10) | Dozens per day |
| R25                | report_group        | Dozens (10) | Dozens per month |
| R26                | report_user        | Dozens (10) | Dozens per day |
| R27                | report_comment        | Dozens (10) | Dozens per day |
| R28                | notification        | Thousands (1k) | Thousands per day |
| R29                | friend_request_notification       | Hundreds (100) | Hundreds per day |
| R30                | friend_request_result_notification       | Dozens (10) | Hundreds per day |
| R31                | liked_post_notification       | Thousands (1k) | Thousands per day |
| R32                | comment_notification       | Thousands (1k) | Thousands per day |
| R33                | liked_comment_notification       | Thousnads (1k) | Thousands per day |
| R34                | private_message_notification       | Hundreds (100) | Hundreds per day |
| R35                | group_message_notification       | Thousands (1k) | Hundreds per day |
| R36                | join_group_request_notification       | Hundreds (100) | Hundreds per week |
| R37                | group_join_request_result_notification       | Dozens (10) | Dozens per week |
| R38                | user_block       | Dozens (10) | Dozens per week |
| R39                | user_tag       | Hundreds (100) | Hundreds per week |
| R40                | admin_block       | Hundreds (100) | Hundreds per month |
| R40                | admin_block       | Dozens (10) | Dozens per week |

<div align="center">

Table 43: PlayNation Database Workload
</div>

<a id="a62"></a>
#### 2. Proposed Indices

<a id="a62.1"></a>
##### 2.1. Performance Indices
 
| **Index**           | IDX01                                  |
| ---                 | ---                                    |
| **Relation**        | R11    |
| **Attribute**       | id_creator   |
| **Type**            | B-tree             |
| **Cardinality**     | Medium |
| **Clustering**      | No                |
| **Justification**   | The table 'post' is considerably large and queries often retrieves posts by a specific user and order them by date. This is done by exact match, on the column id_creator, and and ordering by the field 'date', which is better optimized using a b-tree type index. The application of this index speeds up the processes of fetching all posts of a specific user, joins between 'registered_user' and 'post' and deletion cascades or updates by the user  |
| `SQL code`                                                  | See below

```sql
CREATE INDEX idx_post_creator ON post USING btree (id_creator);
```

<div align="center">

Table 44: Index 1 Table
</div>


| **Index**           | IDX02                                  |
| ---                 | ---                                    |
| **Relation**        | R15    |
| **Attribute**       | id_post   |
| **Type**            | B-tree             |
| **Cardinality**     | High |
| **Clustering**      | No                |
| **Justification**   | The table 'comment' is very large. In fact, each post can have many comments, and queries frequently retrieve comments by post, to display all comments for a given post, for example. This is achieved by exact match to id_post, and ordering, for the comments to be sorted. A B-tree index efficiently supports range and equality lookups, as well as ordering, making its use ideal. This index greatly improves the loading of a post's comments and optimizes joins between 'post' and 'comment' |
| `SQL code`                                                  | See below 

```sql
CREATE INDEX idx_comment_post ON comments USING btree(id_post);
```

<div align="center">

Table 45: Index 2 Table
</div>

| **Index**           | IDX03                                  |
| ---                 | ---                                    |
| **Relation**        | R28    |
| **Attribute**       | id_receiver   |
| **Type**            | B-tree             |
| **Cardinality**     | Medium |
| **Clustering**      | No                |
| **Justification**   | The notification table will be large since each user can receive multiple notifications, and queries frequently retrieve notifications by the receiver (usually ordered by date) so a b-tree index is better suited in this case since it efficiently supports range and equality lookups, as well as ordering.  |
| `SQL code`                                                  | See below

```sql
CREATE INDEX idx_notification_receiver_date ON notification USING btree(id_receiver);
```

<div align="center">

Table 46: Index 3 Table
</div>

<a id="a62.2"></a>
#### 2.2. Full-text Search Indices 

 

| **Index**           | IDX04                                  |
| ---                 | ---                                    |
| **Relation**        | post   |
| **Attribute**       | description   |
| **Type**            | GIN              |
| **Clustering**      | No               |
| **Justification**   | To enable full-text search on posts by matching their descriptions, a GIN typed index was created, which is suitable for this case since the description field is relatively static and does not change frequently. |
| `SQL code`                                                  | See below

```sql

    ALTER TABLE post
    ADD COLUMN tsvectors TSVECTOR;

    CREATE FUNCTION post_search_update() RETURNS TRIGGER AS $$
    BEGIN
        IF TG_OP = 'INSERT' THEN
            NEW.tsvectors := to_tsvector('portuguese', NEW.description);
        ELSIF TG_OP = 'UPDATE' THEN
            IF NEW.description <> OLD.description THEN
                NEW.tsvectors := to_tsvector('portuguese', NEW.description);
            END IF;
        END IF;
        RETURN NEW;
    END $$ LANGUAGE plpgsql;

    CREATE TRIGGER post_search_update
    BEFORE INSERT OR UPDATE ON post
    FOR EACH ROW
    EXECUTE PROCEDURE post_search_update();

    CREATE INDEX search_post ON post USING GIN (tsvectors);
```

<div align="center">

Table 47: Index 4 Table
</div>

| **Index**           | IDX05                                  |
| ---                 | ---                                    |
| **Relation**        | registered_user   |
| **Attribute**       | name, username   |
| **Type**            | GIN              |
| **Clustering**      | No               |
| **Justification**   | To enable full-text search on posts by matching their names or usernames, a GIN typed index was created, which is suitable for this case since the indexed fields are relatively static and do not change frequently.  |
| `SQL code`                                                  | See below

```sql
    ALTER TABLE registered_user
    ADD COLUMN tsvectors TSVECTOR;

    CREATE FUNCTION user_search_update() RETURNS TRIGGER AS $$
    BEGIN
        IF TG_OP = 'INSERT' THEN
            NEW.tsvectors := 
                setweight(to_tsvector('portuguese', NEW.name), 'A') ||
                setweight(to_tsvector('portuguese', NEW.username), 'B');
        ELSIF TG_OP = 'UPDATE' THEN
            IF NEW.name <> OLD.name OR NEW.username <> OLD.username THEN
                NEW.tsvectors := 
                    setweight(to_tsvector('portuguese', NEW.name), 'A') ||
                    setweight(to_tsvector('portuguese', NEW.username), 'B');
            END IF;
        END IF;
        RETURN NEW;
    END $$ LANGUAGE plpgsql;

    CREATE TRIGGER user_search_update
    BEFORE INSERT OR UPDATE ON registered_user
    FOR EACH ROW
    EXECUTE PROCEDURE user_search_update();

    CREATE INDEX search_user ON registered_user USING GIN (tsvectors);
```

<div align="center">

Table 48: Index 5 Table
</div>


| **Index**           | IDX06                                  |
| ---                 | ---                                    |
| **Relation**        | group   |
| **Attribute**       | name, description   |
| **Type**            | GIN              |
| **Clustering**      | No               |
| **Justification**   | To enable full-text search on posts by matching their name s or descriptions, a GIN typed index was created, which is suitable for this case since the indexed fields are relatively static and do not change frequently.   |
| `SQL code`                                                  | See below

```sql
    ALTER TABLE groups
    ADD COLUMN tsvectors TSVECTOR;

    CREATE FUNCTION group_search_update() RETURNS TRIGGER AS $$
    BEGIN
        IF TG_OP = 'INSERT' THEN
            NEW.tsvectors := 
                setweight(to_tsvector('portuguese', NEW.name), 'A') ||
                setweight(to_tsvector('portuguese', NEW.description), 'B');
        ELSIF TG_OP = 'UPDATE' THEN
            IF NEW.name <> OLD.name OR NEW.description <> OLD.description THEN
                NEW.tsvectors := 
                    setweight(to_tsvector('portuguese', NEW.name), 'A') ||
                    setweight(to_tsvector('portuguese', NEW.description), 'B');
            END IF;
        END IF;
        RETURN NEW;
    END $$ LANGUAGE plpgsql;

    CREATE TRIGGER group_search_update
    BEFORE INSERT OR UPDATE ON groups
    FOR EACH ROW
    EXECUTE PROCEDURE group_search_update();

    CREATE INDEX search_group ON groups USING GIN (tsvectors);
```

<div align="center">

Table 49: Index 6 Table
</div>

<a id="a63"></a>
### 3. Triggers
 
This section describes the use of triggers and user defined functions as core database mechanisms for automation. Specifically, they are used to automatically execute tasks in response to data changes and are typically combined to enforce business rules

| **Trigger**      | TRIGGER01                              |
| ---              | ---                                    |
| **Description**  | Profiles can be public or private, but the content of private profiles can only be accessed by their friends (BR01) |
| `SQL code`                                    | See below |

```sql
CREATE FUNCTION check_profile_visibility() RETURNS TRIGGER AS $$
BEGIN
    IF NOT EXISTS (
        SELECT 1 FROM registered_user WHERE id_user = NEW.id_user AND is_public = TRUE
    ) AND NOT EXISTS (
        SELECT 1 FROM user_friend WHERE id_user = NEW.id_user AND id_friend = NEW.id_friend
    ) THEN
        RAISE EXCEPTION 'Cannot access private profile content without being friends';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER profile_visibility_trigger
BEFORE INSERT OR UPDATE ON user_friend
FOR EACH ROW
EXECUTE FUNCTION check_profile_visibility();
```

<div align="center">

Table 50: Trigger 1 Table
</div>


| **Trigger**      | TRIGGER02                              |
| ---              | ---                                    |
| **Description**  | Groups can be public or private, but private ones are only visible to their members (BR02) |
| `SQL code`                                    | See below |

```sql
CREATE FUNCTION check_group_visibility() RETURNS TRIGGER AS $$
BEGIN
    IF NOT EXISTS (
        SELECT 1 FROM groups WHERE id_group = NEW.id_group AND is_public = TRUE
    ) AND NOT EXISTS (
        SELECT 1 FROM group_membership WHERE id_group = NEW.id_group AND id_member = NEW.id_member
    ) THEN
        RAISE EXCEPTION 'Cannot access private group without being a member';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER group_visibility_trigger
BEFORE INSERT OR UPDATE ON group_membership
FOR EACH ROW
EXECUTE FUNCTION check_group_visibility();
```

<div align="center">

Table 51: Trigger 2 Table
</div>

| **Trigger**      | TRIGGER03                              |
| ---              | ---                                    |
| **Description**  | Users cannot send a request to join a group if they are already a member of that group (BR07) |
| `SQL code`                                    | See below |

```sql
CREATE FUNCTION prevent_duplicate_group_join() RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS (
        SELECT 1 FROM group_membership 
        WHERE id_group = NEW.id_group AND id_member = NEW.id_requester
    ) THEN
        RAISE EXCEPTION 'User is already a member of this group';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER no_duplicate_group_join_trigger
BEFORE INSERT ON group_join_request
FOR EACH ROW
EXECUTE FUNCTION prevent_duplicate_group_join();
```

<div align="center">

Table 52: Trigger 3 Table
</div>

| **Trigger**      | TRIGGER04                              |
| ---              | ---                                    |
| **Description**  | A user cannot establish a friendship connection with their own user account (BR08) |
| `SQL code`                                    | See below |

```sql
CREATE FUNCTION prevent_self_friendship() RETURNS TRIGGER AS $$
BEGIN
    IF NEW.id_user = NEW.id_friend THEN
        RAISE EXCEPTION 'A user cannot be friends with themselves';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER no_self_friendship_trigger
BEFORE INSERT OR UPDATE ON user_friend
FOR EACH ROW
EXECUTE FUNCTION prevent_self_friendship();
```

<div align="center">

Table 53: Trigger 4 Table
</div>

| **Trigger**      | TRIGGER05                             |
| ---              | ---                                    |
| **Description**  | A user cannot send a friend request to themselves (BR09) |
| `SQL code`                                    | See below |

```sql
CREATE FUNCTION prevent_self_friend_request() RETURNS TRIGGER AS $$
BEGIN
    IF NEW.id_user = NEW.id_requester THEN
        RAISE EXCEPTION 'A user cannot send a friend request to themselves';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER no_self_friend_request_trigger
BEFORE INSERT ON user_friend_request
FOR EACH ROW
EXECUTE FUNCTION prevent_self_friend_request();
```

<div align="center">

Table 54: Trigger 5 Table
</div>

| **Trigger**      | TRIGGER06                              |
| ---              | ---                                    |
| **Description**  | A user cannot send a friend request to another user if they are already friends (BR10) |
| `SQL code`                                    | See below |

```sql
CREATE FUNCTION prevent_existing_friend_request() RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS (
        SELECT 1 FROM user_friend 
        WHERE (id_user = NEW.id_user AND id_friend = NEW.id_requester)
        OR (id_user = NEW.id_requester AND id_friend = NEW.id_user)
    ) THEN
        RAISE EXCEPTION 'Cannot send friend request to existing friend';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER no_existing_friend_request_trigger
BEFORE INSERT ON user_friend_request
FOR EACH ROW
EXECUTE FUNCTION prevent_existing_friend_request();
```

<div align="center">

Table 55: Trigger 6 Table
</div>

| **Trigger**      | TRIGGER07                              |
| ---              | ---                                    |
| **Description**  | A user may comment or like a post only if the post is from a public user, a user they are friends with, or a group they belong to (BR12) |
| `SQL code`                                    | See below |

```sql
CREATE FUNCTION check_post_interaction_access() RETURNS TRIGGER AS $$
BEGIN
    -- Check if post creator is public
    IF EXISTS (
        SELECT 1 FROM post p
        JOIN registered_user ru ON p.id_creator = ru.id_user
        WHERE p.id_post = NEW.id_post AND ru.is_public = TRUE
    ) THEN
        RETURN NEW;
    END IF;

    -- Check if user is friend with post creator
    IF EXISTS (
        SELECT 1 FROM post p
        JOIN user_friend uf ON p.id_creator = uf.id_user
        WHERE p.id_post = NEW.id_post AND uf.id_friend = NEW.id_user
    ) THEN
        RETURN NEW;
    END IF;

    -- Check if post is in a group where user is member
    IF EXISTS (
        SELECT 1 FROM post p
        JOIN group_membership gm ON p.id_group = gm.id_group
        WHERE p.id_post = NEW.id_post AND gm.id_member = NEW.id_user
    ) THEN
        RETURN NEW;
    END IF;

    RAISE EXCEPTION 'User does not have permission to interact with this post';
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER post_interaction_access_comments_trigger
BEFORE INSERT ON comments
FOR EACH ROW
EXECUTE FUNCTION check_post_interaction_access();

CREATE TRIGGER post_interaction_access_likes_trigger
BEFORE INSERT ON post_like
FOR EACH ROW
EXECUTE FUNCTION check_post_interaction_access();
```

<div align="center">

Table 56: Trigger 7 Table
</div>

| **Trigger**      | TRIGGER08                              |
| ---              | ---                                    |
| **Description**  | A user is only authorized to post on a group if they are a member of that specific group (BR13) |
| `SQL code`                                    | See below |

```sql
CREATE FUNCTION check_group_post_permission() RETURNS TRIGGER AS $$
BEGIN
    IF NOT EXISTS (
        SELECT 1 FROM group_membership
        WHERE id_group = NEW.id_group AND id_member = NEW.id_sender
    ) THEN
        RAISE EXCEPTION 'User must be a member of the group to send messages';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER group_post_permission_trigger
BEFORE INSERT ON group_message
FOR EACH ROW
EXECUTE FUNCTION check_group_post_permission();
```

<div align="center">

Table 57: Trigger 8 Table
</div>

| **Trigger**      | TRIGGER09                              |
| ---              | ---                                    |
| **Description**  | A user is restricted to liking a specific comment or post only once (BR14) |
| `SQL code`                                    | See below |

```sql
CREATE FUNCTION prevent_duplicate_likes() RETURNS TRIGGER AS $$
BEGIN
    IF TG_TABLE_NAME = 'post_like' THEN
        IF EXISTS (
            SELECT 1 FROM post_like
            WHERE id_post = NEW.id_post AND id_user = NEW.id_user
        ) THEN
            RAISE EXCEPTION 'User has already liked this post';
        END IF;
    ELSIF TG_TABLE_NAME = 'comment_like' THEN
        IF EXISTS (
            SELECT 1 FROM comment_like
            WHERE id_comment = NEW.id_comment AND id_user = NEW.id_user
        ) THEN
            RAISE EXCEPTION 'User has already liked this comment';
        END IF;
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER single_post_like_trigger
BEFORE INSERT ON post_like
FOR EACH ROW
EXECUTE FUNCTION prevent_duplicate_likes();

CREATE TRIGGER single_comment_like_trigger
BEFORE INSERT ON comment_like
FOR EACH ROW
EXECUTE FUNCTION prevent_duplicate_likes();
```

<div align="center">

Table 58: Trigger 9 Table
</div>

| **Trigger**      | TRIGGER10                              |
| ---              | ---                                    |
| **Description**  | Any new post must contain at least one of the following elements: a description (text content) or an image (BR15) |
| `SQL code`                                    | See below |

```sql
CREATE FUNCTION check_post_content() RETURNS TRIGGER AS $$
BEGIN
    IF NEW.description IS NULL AND NEW.image IS NULL THEN
        RAISE EXCEPTION 'Post must have either a description or an image';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER post_content_trigger
BEFORE INSERT OR UPDATE ON post
FOR EACH ROW
EXECUTE FUNCTION check_post_content();
```
<div align="center">

Table 59: Trigger 10 Table
</div>                                         

<a id="a64"></a>
#### 4. Transactions

We implement Transactions to assure the integrity of the data when, to perform an action, many operations are necessary.   

| Transaction   | TRAN01                    |
| --------------- | ----------------------------------- |
| Justification   | Send a friend request: the operation inserts into both user_friend_request and notification and avoids cases where a request exists without a notification or vice-versa.   |
| Isolation level | SERIALIZABLE |
| `Complete SQL Code`                                   | See below |

```sql
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

INSERT INTO user_friend_request (id_user, id_requester)
VALUES ($id_user, $id_requester);

INSERT INTO notification (id_receiver, id_emitter, text, date, read)
VALUES ($id_user, $id_requester, $text, NOW(), FALSE);

INSERT INTO friend_request_notification (id_notification, accepted)
VALUES (currval(pg_get_serial_sequence('notification', 'id_notification')), NULL);

COMMIT;
```

<div align="center">

Table 60: Transaction 1 Table
</div>

| Transaction   | TRAN02                    |
| --------------- | ----------------------------------- |
| Justification   | Accept friend request: create reciprocal friendship, remove request and produce result notification to avoid partial state.   |
| Isolation level | SERIALIZABLE |
| `Complete SQL Code`                                   | See below |

```sql
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

INSERT INTO user_friend (id_user, id_friend)
VALUES ($id_accepter, $id_requester), ($id_requester, $id_accepter);

DELETE FROM user_friend_request
WHERE id_user = $id_accepter AND id_requester = $id_requester;

UPDATE friend_request_notification
SET accepted = TRUE
WHERE id_notification = $original_notification_id;

INSERT INTO notification (id_receiver, id_emitter, text, date, read)
VALUES ($id_requester, $id_accepter, $text, NOW(), FALSE);

INSERT INTO friend_request_result_notification (id_notification)
VALUES (currval(pg_get_serial_sequence('notification', 'id_notification')));

COMMIT;
```

<div align="center">

Table 61: Transaction 2 Table
</div>

| Transaction   | TRAN03                    |
| --------------- | ----------------------------------- |
| Justification   | Remove friend: delete both directional friendship rows to avoid asymmetric state.   |
| Isolation level | SERIALIZABLE |
| `Complete SQL Code`                                   | See below |

```sql
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

DELETE FROM user_friend
WHERE (id_user = $id_user AND id_friend = $id_friend) OR (id_user = $id_friend AND id_friend = $id_user);

COMMIT;
```

<div align="center">

Table 62: Transaction 3 Table
</div>

| Transaction   | TRAN04                    |
| --------------- | ----------------------------------- |
| Justification   | Create a post: create it and attach label using the correct sequence id; prevent races on currval.   |
| Isolation level | SERIALIZABLE |
| `Complete SQL Code`                                   | See below |

```sql
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

INSERT INTO post (id_creator, image, description, date)
VALUES ($id_creator, $image, $description, NOW());

INSERT INTO post_label (id_post, id_label)
VALUES (currval(pg_get_serial_sequence('post', 'id_post')), $id_label);

COMMIT;
```

<div align="center">

Table 63: Transaction 4 Table
</div>

| Transaction   | TRAN05                    |
| --------------- | ----------------------------------- |
| Justification   | Like post: insert like and its notification together to avoid duplicate notifications.    |
| Isolation level | SERIALIZABLE |
| `Complete SQL Code`                                   | See below |

```sql
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

INSERT INTO post_like (id_post, id_user)
VALUES ($id_post, $id_user);

INSERT INTO notification (id_receiver, id_emitter, text, date, read)
VALUES ($id_receiver, $id_user, $text, NOW(), FALSE);

INSERT INTO like_post_notification (id_notification, id_post)
VALUES (currval(pg_get_serial_sequence('notification', 'id_notification')), $id_post);

COMMIT;
```

<div align="center">

Table 64: Transaction 5 Table
</div>

| Transaction   | TRAN06                    |
| --------------- | ----------------------------------- |
| Justification   | Comment on post: create comment then notification referencing that comment atomically to ensure correct ids.     |
| Isolation level | SERIALIZABLE |
| `Complete SQL Code`                                   | See below |

```sql
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

INSERT INTO comments (id_post, id_user, id_reply, text, date)
VALUES ($id_post, $id_user, $id_reply, $text, NOW());

INSERT INTO notification (id_receiver, id_emitter, text, date, read)
VALUES ($id_receiver, $id_user, $text, NOW(), FALSE);

INSERT INTO comment_notification (id_notification, id_comment)
VALUES (currval(pg_get_serial_sequence('notification', 'id_notification')), currval(pg_get_serial_sequence('comments', 'id_comment')));

COMMIT;
```

<div align="center">

Table 65: Transaction 6 Table
</div>

| Transaction   | TRAN07                    |
| --------------- | ----------------------------------- |
| Justification   | Share post via private message: create message, private_message and its notification atomically to avoid sequence/id mismatches.     |
| Isolation level | SERIALIZABLE |
| `Complete SQL Code`                                   | See below |

```sql
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

INSERT INTO message (text, image, date)
VALUES ($text, $image, NOW());

INSERT INTO private_message (id_message, id_sender, id_receiver)
VALUES (currval(pg_get_serial_sequence('message', 'id_message')), $id_sender, $id_receiver);

INSERT INTO notification (id_receiver, id_emitter, text, date, read)
VALUES ($id_receiver, $id_sender, $text, NOW(), FALSE);

INSERT INTO private_message_notification (id_notification, id_message)
VALUES (currval(pg_get_serial_sequence('notification', 'id_notification')), currval(pg_get_serial_sequence('message', 'id_message')));

COMMIT;
```

<div align="center">

Table 66: Transaction 7 Table
</div>

| Transaction   | TRAN08                    |
| --------------- | ----------------------------------- |
| Justification   | Send message to friend: send plain private message and notification atomically to ensure consistent references.     |
| Isolation level | SERIALIZABLE |
| `Complete SQL Code`                                   | See below |

```sql
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

INSERT INTO message (text, image, date)
VALUES ($text, NULL, NOW());

INSERT INTO private_message (id_message, id_sender, id_receiver)
VALUES (currval(pg_get_serial_sequence('message', 'id_message')), $id_sender, $id_receiver);

INSERT INTO notification (id_receiver, id_emitter, text, date, read)
VALUES ($id_receiver, $id_sender, $text, NOW(), FALSE);

INSERT INTO private_message_notification (id_notification, id_message)
VALUES (currval(pg_get_serial_sequence('notification', 'id_notification')), currval(pg_get_serial_sequence('message', 'id_message')));

COMMIT;
```

<div align="center">

Table 67: Transaction 8 Table
</div>

| Transaction   | TRAN09                    |
| --------------- | ----------------------------------- |
| Justification   | Post on group: create group message and per-member notifications in a function so all related inserts are produced as a unit.     |
| Isolation level | SERIALIZABLE |
| `Complete SQL Code`                                   | See below |

```sql
CREATE OR REPLACE FUNCTION post_group_message(
    sender_id INTEGER,
    group_id INTEGER,
    message_text TEXT,
    message_image TEXT
)
RETURNS VOID AS $$
DECLARE
    new_message_id INTEGER;
    notification_id INTEGER;
    receiver_id INTEGER;
BEGIN

    INSERT INTO message (text, image, date)
    VALUES (message_text, message_image, NOW())
    RETURNING id_message INTO new_message_id;

    INSERT INTO group_message (id_message, id_sender, id_group)
    VALUES (new_message_id, sender_id, group_id);

    FOR receiver_id IN
        SELECT id_member
        FROM group_membership
        WHERE id_group = group_id AND id_member <> sender_id
    LOOP
        INSERT INTO notification (id_receiver, id_emitter, text, date, read)
        VALUES (receiver_id, sender_id, message_text, NOW(), FALSE)
        RETURNING id_notification INTO notification_id;

        INSERT INTO group_message_notification (id_notification, id_message)
        VALUES (notification_id, new_message_id);
    END LOOP;

END;
$$ LANGUAGE plpgsql;
```

<div align="center">

Table 68: Transaction 9 Table
</div>

| Transaction   | TRAN10                    |
| --------------- | ----------------------------------- |
| Justification   | Create group: create it, ensure owner exists and add owner membership atomically to avoid partial group state.
--      |
| Isolation level | SERIALIZABLE |
| `Complete SQL Code`                                   | See below |

```sql
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

INSERT INTO group_owner (id_group_owner)
VALUES ($id_group_owner)
ON CONFLICT (id_group_owner) DO NOTHING;

INSERT INTO groups (id_owner, name, description, picture, is_public)
VALUES ($id_group_owner, $name, $description, $picture, TRUE);

INSERT INTO group_membership (id_group, id_member)
VALUES (currval(pg_get_serial_sequence('groups', 'id_group')), $id_group_owner);

COMMIT;
```

<div align="center">

Table 69: Transaction 10 Table
</div>

| Transaction   | TRAN11                    |
| --------------- | ----------------------------------- |
| Justification   | Send request to join group: create join request and notification together so owner can act on a valid request.|
| Isolation level | SERIALIZABLE |
| `Complete SQL Code`                                   | See below |

```sql
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

INSERT INTO group_join_request (id_group, id_requester)
VALUES ($id_group, $id_requester);

INSERT INTO notification (id_receiver, id_emitter, text, date, read)
VALUES ($id_receiver, $id_emitter, $text, NOW(), FALSE);

INSERT INTO join_group_request_notification (id_notification, id_group, accepted)
VALUES (currval(pg_get_serial_sequence('notification', 'id_notification')), $id_group, NULL);

COMMIT;
```

<div align="center">

Table 70: Transaction 11 Table
</div>

| Transaction   | TRAN12                    |
| --------------- | ----------------------------------- |
| Justification   | Accept join group request: remove request, add membership, update original notification and notify requester atomically.|
| Isolation level | SERIALIZABLE |
| `Complete SQL Code`                                   | See below |

```sql
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

DELETE FROM group_join_request
WHERE id_group = $id_group AND id_requester = $id_requester;

INSERT INTO group_membership (id_group, id_member)
VALUES ($id_group, $id_requester);

UPDATE join_group_request_notification
SET accepted = TRUE
WHERE id_notification = $original_notification_id;

INSERT INTO notification (id_receiver, id_emitter, text, date, read)
VALUES ($id_requester, $id_group_owner, $text, NOW(), FALSE);

INSERT INTO join_group_request_result_notification (id_notification, id_group)
VALUES (currval(pg_get_serial_sequence('notification', 'id_notification')), $id_group);

COMMIT;
```

<div align="center">

Table 71: Transaction 12 Table
</div>

| Transaction   | TRAN13                    |
| --------------- | ----------------------------------- |
| Justification   | Report post: insert report and link to post; READ COMMITTED is enough for independent reporting inserts. The same logic is applied to Report a comment, Report a profile and to Report a group. |
| Isolation level | SERIALIZABLE |
| `Complete SQL Code`                                   | See below |

```sql
BEGIN TRANSACTION ISOLATION LEVEL READ COMMITTED;

INSERT INTO report (description)
VALUES ($description);

INSERT INTO report_post (id_report, id_post)
VALUES (currval(pg_get_serial_sequence('report', 'id_report')), $id_post);

COMMIT;
```

<div align="center">

Table 72: Transaction 13 Table
</div>

| Transaction   | TRAN14                    |
| --------------- | ----------------------------------- |
| Justification   | Delete account: delete user and rely on cascades; run atomically to avoid concurrent recreation or partial cleanup. |
| Isolation level | SERIALIZABLE |
| `Complete SQL Code`                                   | See below |

```sql
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

DELETE FROM registered_user
WHERE id_user = $id_user;

COMMIT;
```

<div align="center">

Table 73: Transaction 14 Table
</div>

| Transaction   | TRAN15                    |
| --------------- | ----------------------------------- |
| Justification   | Block a user: record block and remove friendships atomically to avoid transient friend state. |
| Isolation level | SERIALIZABLE |
| `Complete SQL Code`                                   | See below |

```sql
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

INSERT INTO user_block (id_user, id_blocked)
VALUES ($id_user, $id_blocked);

DELETE FROM user_friend
WHERE (id_user = $id_user AND id_friend = $id_blocked)
OR (id_user = $id_blocked AND id_friend = $id_user);

COMMIT;
```

<div align="center">

Table 74: Transaction 15 Table
</div>

| Transaction   | TRAN16                    |
| --------------- | ----------------------------------- |
| Justification   | Unblock a user: remove block record atomically so dependent operations see a consistent block state.  |
| Isolation level | SERIALIZABLE |
| `Complete SQL Code`                                   | See below |

```sql
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

DELETE FROM user_block
WHERE id_user = $id_user AND id_blocked = $id_blocked;

COMMIT;
```

<div align="center">

Table 75: Transaction 16 Table
</div>

| Transaction   | TRAN17                    |
| --------------- | ----------------------------------- |
| Justification   | Remove reported post: remove it and notify atomically to avoid orphaned notifications or inconsistent moderation state.  |
| Isolation level | SERIALIZABLE |
| `Complete SQL Code`                                   | See below |

```sql
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

DELETE FROM post
WHERE id_post = $id_post;

INSERT INTO notification (id_receiver, id_emitter, text, date, read)
VALUES ($id_receiver, NULL, $text, NOW(), FALSE);

COMMIT;
```

<div align="center">

Table 76: Transaction 17 Table
</div>

<a id="sql"></a>
### Annex A. SQL Code 

The PlayNation Database Schema is available [here](https://gitlab.up.pt/lbaw/lbaw2526/lbaw2551/-/blob/main/create.sql?ref_type=heads).

The PlayNation Database Population Script is available [here](https://gitlab.up.pt/lbaw/lbaw2526/lbaw2551/-/blob/main/populate.sql?ref_type=heads).


<a id="sqla"></a>
#### A.1. Database schema

 ```sql
CREATE SCHEMA IF NOT EXISTS lbaw2551;
-- drop tables 

DROP TABLE IF EXISTS join_group_request_result_notification CASCADE;
DROP TABLE IF EXISTS join_group_request_notification CASCADE;
DROP TABLE IF EXISTS group_message_notification CASCADE;
DROP TABLE IF EXISTS private_message_notification CASCADE;
DROP TABLE IF EXISTS like_comment_notification CASCADE;
DROP TABLE IF EXISTS comment_notification CASCADE;
DROP TABLE IF EXISTS like_post_notification CASCADE;
DROP TABLE IF EXISTS friend_request_result_notification CASCADE;
DROP TABLE IF EXISTS friend_request_notification CASCADE;
DROP TABLE IF EXISTS group_message CASCADE;
DROP TABLE IF EXISTS private_message CASCADE;
DROP TABLE IF EXISTS report_post CASCADE;
DROP TABLE IF EXISTS report_group CASCADE;
DROP TABLE IF EXISTS report_user CASCADE;
DROP TABLE IF EXISTS report_comment CASCADE;
DROP TABLE IF EXISTS report CASCADE;
DROP TABLE IF EXISTS comment_like CASCADE;
DROP TABLE IF EXISTS comments CASCADE;
DROP TABLE IF EXISTS post_save CASCADE;
DROP TABLE IF EXISTS post_like CASCADE;
DROP TABLE IF EXISTS post_label CASCADE;
DROP TABLE IF EXISTS post CASCADE;
DROP TABLE IF EXISTS user_label CASCADE;
DROP TABLE IF EXISTS category CASCADE;
DROP TABLE IF EXISTS sport CASCADE;
DROP TABLE IF EXISTS label CASCADE;
DROP TABLE IF EXISTS group_membership CASCADE;
DROP TABLE IF EXISTS group_join_request CASCADE;
DROP TABLE IF EXISTS groups CASCADE;
DROP TABLE IF EXISTS user_friend_request CASCADE;
DROP TABLE IF EXISTS user_friend CASCADE;
DROP TABLE IF EXISTS notification CASCADE;
DROP TABLE IF EXISTS group_owner CASCADE;
DROP TABLE IF EXISTS verified_user CASCADE;
DROP TABLE IF EXISTS administrator CASCADE;
DROP TABLE IF EXISTS registered_user CASCADE;
DROP TABLE IF EXISTS user_block CASCADE;
DROP TABLE IF EXISTS user_tag CASCADE;
DROP TABLE IF EXISTS message CASCADE;
DROP TABLE IF EXISTS admin_block CASCADE;
DROP TABLE IF EXISTS admin_ban CASCADE;

-- create tables

CREATE TABLE registered_user(
    id_user SERIAL PRIMARY KEY,
    username TEXT UNIQUE NOT NULL,
    name TEXT NOT NULL,
    email TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    biography TEXT,
    profile_picture TEXT,
    is_public BOOLEAN DEFAULT TRUE
);

CREATE TABLE administrator(
    id_admin INTEGER PRIMARY KEY REFERENCES registered_user (id_user) ON DELETE CASCADE
);

CREATE TABLE verified_user(
    id_verified INTEGER PRIMARY KEY REFERENCES registered_user (id_user) ON DELETE CASCADE
);

CREATE TABLE group_owner(
    id_group_owner INTEGER PRIMARY KEY REFERENCES registered_user (id_user) ON DELETE CASCADE
);

CREATE TABLE user_friend(
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    id_friend INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_user, id_friend)
);

CREATE TABLE user_friend_request(
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    id_requester INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_user, id_requester)
);

CREATE TABLE label(
    id_label SERIAL PRIMARY KEY,
    designation TEXT NOT NULL,
    image TEXT NOT NULL
);

CREATE TABLE sport(
    id_sport INTEGER PRIMARY KEY REFERENCES label (id_label) ON DELETE CASCADE
);

CREATE TABLE category(
    id_category INTEGER PRIMARY KEY REFERENCES label (id_label) ON DELETE CASCADE
);

CREATE TABLE user_label(
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    id_label INTEGER NOT NULL REFERENCES label (id_label) ON DELETE CASCADE,
    PRIMARY KEY (id_user, id_label)
);

CREATE TABLE post(
    id_post SERIAL PRIMARY KEY,
    id_creator INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE SET NULL,
    image TEXT NOT NULL,
    description TEXT NOT NULL,
    date TIMESTAMP NOT NULL CHECK (date<=now())
);

CREATE TABLE post_label(
    id_post INTEGER NOT NULL REFERENCES post (id_post) ON DELETE CASCADE,
    id_label INTEGER NOT NULL REFERENCES label (id_label) ON DELETE CASCADE,
    PRIMARY KEY (id_post, id_label)
);

CREATE TABLE post_like(
    id_post INTEGER NOT NULL REFERENCES post (id_post) ON DELETE CASCADE,
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_post, id_user)
);

CREATE TABLE post_save(
    id_post INTEGER NOT NULL REFERENCES post (id_post) ON DELETE CASCADE,
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_post, id_user)
);

CREATE TABLE comments(
    id_comment SERIAL PRIMARY KEY,
    id_post INTEGER NOT NULL REFERENCES post (id_post) ON DELETE CASCADE,
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE SET NULL,
    id_reply INTEGER REFERENCES comments (id_comment) ON DELETE CASCADE,
    text TEXT NOT NULL,
    date TIMESTAMP NOT NULL CHECK (date<=now())
);

CREATE TABLE comment_like(
    id_comment INTEGER NOT NULL REFERENCES comments (id_comment) ON DELETE CASCADE,
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_comment, id_user)
);

CREATE TABLE groups(
    id_group SERIAL PRIMARY KEY,
    id_owner INTEGER NOT NULL REFERENCES group_owner (id_group_owner) ON DELETE SET NULL,
    name TEXT UNIQUE NOT NULL,
    description TEXT,
    picture TEXT,
    is_public BOOLEAN DEFAULT TRUE
);

CREATE TABLE group_membership(
    id_group INTEGER NOT NULL REFERENCES groups (id_group) ON DELETE CASCADE,
    id_member INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_group, id_member)
);

CREATE TABLE group_join_request(
    id_group INTEGER NOT NULL REFERENCES groups (id_group) ON DELETE CASCADE,
    id_requester INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_group, id_requester)
);

CREATE TABLE message(
    id_message SERIAL PRIMARY KEY,
    text TEXT NOT NULL,
    image TEXT,
    date TIMESTAMP NOT NULL CHECK (date<=now())
);

CREATE TABLE private_message(
    id_message INTEGER PRIMARY KEY REFERENCES message (id_message) ON DELETE CASCADE,
    id_sender INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    id_receiver INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE
);

CREATE TABLE group_message(
    id_message INTEGER PRIMARY KEY REFERENCES message (id_message) ON DELETE CASCADE,
    id_group INTEGER NOT NULL REFERENCES groups (id_group) ON DELETE CASCADE,
    id_sender INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE
);

CREATE TABLE report(
    id_report SERIAL PRIMARY KEY,
    description TEXT NOT NULL
);

--
CREATE TABLE report_comment(
    id_report INTEGER NOT NULL REFERENCES report (id_report) ON DELETE CASCADE,
    id_comment INTEGER NOT NULL REFERENCES comments (id_comment) ON DELETE CASCADE,
    PRIMARY KEY (id_report, id_comment)
);

CREATE TABLE report_user(
    id_report INTEGER NOT NULL REFERENCES report (id_report) ON DELETE CASCADE,
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_report, id_user)
);

CREATE TABLE report_group(
    id_report INTEGER NOT NULL REFERENCES report (id_report) ON DELETE CASCADE,
    id_group INTEGER NOT NULL REFERENCES groups (id_group) ON DELETE CASCADE,
    PRIMARY KEY (id_report, id_group)
);

CREATE TABLE report_post(
    id_report INTEGER NOT NULL REFERENCES report (id_report) ON DELETE CASCADE,
    id_post INTEGER NOT NULL REFERENCES post (id_post) ON DELETE CASCADE,
    PRIMARY KEY (id_report, id_post)
);

CREATE TABLE notification(
    id_notification SERIAL PRIMARY KEY,
    id_receiver INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    id_emitter INTEGER REFERENCES registered_user (id_user) ON DELETE SET NULL,
    text TEXT NOT NULL,
    date TIMESTAMP NOT NULL CHECK (date<=now())
);

CREATE TABLE friend_request_notification(
    id_notification INTEGER PRIMARY KEY REFERENCES notification (id_notification) ON DELETE CASCADE,
    accepted BOOLEAN
);

CREATE TABLE friend_request_result_notification(
    id_notification INTEGER PRIMARY KEY REFERENCES notification (id_notification) ON DELETE CASCADE
);

CREATE TABLE like_post_notification(
    id_notification INTEGER PRIMARY KEY REFERENCES notification (id_notification) ON DELETE CASCADE,
    id_post INTEGER NOT NULL REFERENCES post (id_post) ON DELETE CASCADE
);

CREATE TABLE comment_notification(
    id_notification INTEGER PRIMARY KEY REFERENCES notification (id_notification) ON DELETE CASCADE,
    id_comment INTEGER NOT NULL REFERENCES comments (id_comment) ON DELETE CASCADE
);

CREATE TABLE like_comment_notification(
    id_notification INTEGER PRIMARY KEY REFERENCES notification (id_notification) ON DELETE CASCADE,
    id_comment INTEGER NOT NULL REFERENCES comments (id_comment) ON DELETE CASCADE
);

CREATE TABLE private_message_notification(
    id_notification INTEGER PRIMARY KEY REFERENCES notification (id_notification) ON DELETE CASCADE,
    id_message INTEGER NOT NULL REFERENCES message (id_message) ON DELETE CASCADE
);

CREATE TABLE group_message_notification(
    id_notification INTEGER PRIMARY KEY REFERENCES notification (id_notification) ON DELETE CASCADE,
    id_message INTEGER NOT NULL REFERENCES group_message (id_message) ON DELETE CASCADE
);

CREATE TABLE join_group_request_notification(
    id_notification INTEGER PRIMARY KEY REFERENCES notification (id_notification) ON DELETE CASCADE,
    id_group INTEGER NOT NULL REFERENCES groups (id_group) ON DELETE CASCADE,
    accepted BOOLEAN
);


CREATE TABLE join_group_request_result_notification(
    id_notification INTEGER PRIMARY KEY REFERENCES notification (id_notification) ON DELETE CASCADE,
    id_group INTEGER NOT NULL REFERENCES groups (id_group) ON DELETE CASCADE
);

CREATE TABLE user_block(
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    id_blocked INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_user, id_blocked)
);

CREATE TABLE user_tag(
    id_post INTEGER NOT NULL REFERENCES post (id_post) ON DELETE CASCADE,
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_post, id_user)
);

CREATE TABLE admin_block(
    id_admin INTEGER NOT NULL REFERENCES administrator (id_admin) ON DELETE CASCADE,
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_admin, id_user)
);

CREATE TABLE admin_ban(
    id_admin INTEGER NOT NULL REFERENCES administrator (id_admin) ON DELETE CASCADE,
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_admin, id_user)
);

-- Indexes

DROP FUNCTION IF EXISTS post_search_update() CASCADE;
DROP FUNCTION IF EXISTS user_search_update() CASCADE;
DROP FUNCTION IF EXISTS group_search_update() CASCADE;

CREATE INDEX idx_post_creator ON post USING btree (id_creator);

CREATE INDEX idx_comment_post ON comments USING btree(id_post);
CLUSTER comments USING idx_comment_post;

CREATE INDEX idx_notification_receiver_date ON notification USING btree(id_receiver);
CLUSTER notification USING idx_notification_receiver_date;

-- FTS Indexes

ALTER TABLE post
ADD COLUMN tsvectors TSVECTOR;

CREATE FUNCTION post_search_update() RETURNS TRIGGER AS $$
BEGIN
    IF TG_OP = 'INSERT' THEN
        NEW.tsvectors := to_tsvector('portuguese', NEW.description);
    ELSIF TG_OP = 'UPDATE' THEN
        IF NEW.description <> OLD.description THEN
            NEW.tsvectors := to_tsvector('portuguese', NEW.description);
        END IF;
    END IF;
    RETURN NEW;
END $$ LANGUAGE plpgsql;

CREATE TRIGGER post_search_update
BEFORE INSERT OR UPDATE ON post
FOR EACH ROW
EXECUTE PROCEDURE post_search_update();

CREATE INDEX search_post ON post USING GIN (tsvectors);

ALTER TABLE registered_user
ADD COLUMN tsvectors TSVECTOR;

CREATE FUNCTION user_search_update() RETURNS TRIGGER AS $$
BEGIN
    IF TG_OP = 'INSERT' THEN
        NEW.tsvectors := 
            setweight(to_tsvector('portuguese', NEW.name), 'A') ||
            setweight(to_tsvector('portuguese', NEW.username), 'B');
    ELSIF TG_OP = 'UPDATE' THEN
        IF NEW.name <> OLD.name OR NEW.username <> OLD.username THEN
            NEW.tsvectors := 
                setweight(to_tsvector('portuguese', NEW.name), 'A') ||
                setweight(to_tsvector('portuguese', NEW.username), 'B');
        END IF;
    END IF;
    RETURN NEW;
END $$ LANGUAGE plpgsql;

CREATE TRIGGER user_search_update
BEFORE INSERT OR UPDATE ON registered_user
FOR EACH ROW
EXECUTE PROCEDURE user_search_update();

CREATE INDEX search_user ON registered_user USING GIN (tsvectors);

ALTER TABLE groups
ADD COLUMN tsvectors TSVECTOR;

CREATE FUNCTION group_search_update() RETURNS TRIGGER AS $$
BEGIN
    IF TG_OP = 'INSERT' THEN
        NEW.tsvectors := 
            setweight(to_tsvector('portuguese', NEW.name), 'A') ||
            setweight(to_tsvector('portuguese', NEW.description), 'B');
    ELSIF TG_OP = 'UPDATE' THEN
        IF NEW.name <> OLD.name OR NEW.description <> OLD.description THEN
            NEW.tsvectors := 
                setweight(to_tsvector('portuguese', NEW.name), 'A') ||
                setweight(to_tsvector('portuguese', NEW.description), 'B');
        END IF;
    END IF;
    RETURN NEW;
END $$ LANGUAGE plpgsql;

CREATE TRIGGER group_search_update
BEFORE INSERT OR UPDATE ON groups
FOR EACH ROW
EXECUTE PROCEDURE group_search_update();

CREATE INDEX search_group ON groups USING GIN (tsvectors);



-- Triggers

DROP FUNCTION IF EXISTS check_profile_visibility() CASCADE;
DROP FUNCTION IF EXISTS check_group_visibility() CASCADE;
DROP FUNCTION IF EXISTS prevent_duplicate_group_join() CASCADE;
DROP FUNCTION IF EXISTS prevent_self_friendship() CASCADE;
DROP FUNCTION IF EXISTS prevent_self_friend_request() CASCADE;
DROP FUNCTION IF EXISTS prevent_existing_friend_request() CASCADE;
DROP FUNCTION IF EXISTS check_post_interaction_access() CASCADE;
DROP FUNCTION IF EXISTS check_group_post_permission() CASCADE;
DROP FUNCTION IF EXISTS prevent_duplicate_likes() CASCADE;
DROP FUNCTION IF EXISTS check_post_content() CASCADE;

-- BR01: Profile Visibility
CREATE FUNCTION check_profile_visibility() RETURNS TRIGGER AS $$
BEGIN
    IF NOT EXISTS (
        SELECT 1 FROM registered_user WHERE id_user = NEW.id_user AND is_public = TRUE
    ) AND NOT EXISTS (
        SELECT 1 FROM user_friend WHERE id_user = NEW.id_user AND id_friend = NEW.id_friend
    ) THEN
        RAISE EXCEPTION 'Cannot access private profile content without being friends';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER profile_visibility_trigger
BEFORE INSERT OR UPDATE ON user_friend
FOR EACH ROW
EXECUTE FUNCTION check_profile_visibility();

-- BR02: Group Visibility
CREATE FUNCTION check_group_visibility() RETURNS TRIGGER AS $$
BEGIN
    IF NOT EXISTS (
        SELECT 1 FROM groups WHERE id_group = NEW.id_group AND is_public = TRUE
    ) AND NOT EXISTS (
        SELECT 1 FROM group_membership WHERE id_group = NEW.id_group AND id_member = NEW.id_member
    ) THEN
        RAISE EXCEPTION 'Cannot access private group without being a member';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER group_visibility_trigger
BEFORE INSERT OR UPDATE ON group_membership
FOR EACH ROW
EXECUTE FUNCTION check_group_visibility();

-- BR07: Group Join Restriction
CREATE FUNCTION prevent_duplicate_group_join() RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS (
        SELECT 1 FROM group_membership 
        WHERE id_group = NEW.id_group AND id_member = NEW.id_requester
    ) THEN
        RAISE EXCEPTION 'User is already a member of this group';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER no_duplicate_group_join_trigger
BEFORE INSERT ON group_join_request
FOR EACH ROW
EXECUTE FUNCTION prevent_duplicate_group_join();

-- BR08: Self-Friending Prohibition
CREATE FUNCTION prevent_self_friendship() RETURNS TRIGGER AS $$
BEGIN
    IF NEW.id_user = NEW.id_friend THEN
        RAISE EXCEPTION 'A user cannot be friends with themselves';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER no_self_friendship_trigger
BEFORE INSERT OR UPDATE ON user_friend
FOR EACH ROW
EXECUTE FUNCTION prevent_self_friendship();

-- BR09: Self-Request Prohibition
CREATE FUNCTION prevent_self_friend_request() RETURNS TRIGGER AS $$
BEGIN
    IF NEW.id_user = NEW.id_requester THEN
        RAISE EXCEPTION 'A user cannot send a friend request to themselves';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER no_self_friend_request_trigger
BEFORE INSERT ON user_friend_request
FOR EACH ROW
EXECUTE FUNCTION prevent_self_friend_request();

-- BR10: Existing Friend Request Prohibition
CREATE FUNCTION prevent_existing_friend_request() RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS (
        SELECT 1 FROM user_friend 
        WHERE (id_user = NEW.id_user AND id_friend = NEW.id_requester)
        OR (id_user = NEW.id_requester AND id_friend = NEW.id_user)
    ) THEN
        RAISE EXCEPTION 'Cannot send friend request to existing friend';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER no_existing_friend_request_trigger
BEFORE INSERT ON user_friend_request
FOR EACH ROW
EXECUTE FUNCTION prevent_existing_friend_request();


-- BR12: Post Interaction Access
CREATE FUNCTION check_post_interaction_access() RETURNS TRIGGER AS $$
BEGIN
    -- Check if post creator is public
    IF EXISTS (
        SELECT 1 FROM post p
        JOIN registered_user ru ON p.id_creator = ru.id_user
        WHERE p.id_post = NEW.id_post AND ru.is_public = TRUE
    ) THEN
        RETURN NEW;
    END IF;

    -- Check if user is friend with post creator
    IF EXISTS (
        SELECT 1 FROM post p
        JOIN user_friend uf ON p.id_creator = uf.id_user
        WHERE p.id_post = NEW.id_post AND uf.id_friend = NEW.id_user
    ) THEN
        RETURN NEW;
    END IF;

    -- Check if post is in a group where user is member
    IF EXISTS (
        SELECT 1 FROM post p
        JOIN group_membership gm ON p.id_group = gm.id_group
        WHERE p.id_post = NEW.id_post AND gm.id_member = NEW.id_user
    ) THEN
        RETURN NEW;
    END IF;

    RAISE EXCEPTION 'User does not have permission to interact with this post';
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER post_interaction_access_comments_trigger
BEFORE INSERT ON comments
FOR EACH ROW
EXECUTE FUNCTION check_post_interaction_access();

CREATE TRIGGER post_interaction_access_likes_trigger
BEFORE INSERT ON post_like
FOR EACH ROW
EXECUTE FUNCTION check_post_interaction_access();


-- BR13: Group Post Membership Required
CREATE FUNCTION check_group_post_permission() RETURNS TRIGGER AS $$
BEGIN
    IF NOT EXISTS (
        SELECT 1 FROM group_membership
        WHERE id_group = NEW.id_group AND id_member = NEW.id_sender
    ) THEN
        RAISE EXCEPTION 'User must be a member of the group to send messages';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER group_post_permission_trigger
BEFORE INSERT ON group_message
FOR EACH ROW
EXECUTE FUNCTION check_group_post_permission();


-- BR14: Single Like Constraint
CREATE FUNCTION prevent_duplicate_likes() RETURNS TRIGGER AS $$
BEGIN
    IF TG_TABLE_NAME = 'post_like' THEN
        IF EXISTS (
            SELECT 1 FROM post_like
            WHERE id_post = NEW.id_post AND id_user = NEW.id_user
        ) THEN
            RAISE EXCEPTION 'User has already liked this post';
        END IF;
    ELSIF TG_TABLE_NAME = 'comment_like' THEN
        IF EXISTS (
            SELECT 1 FROM comment_like
            WHERE id_comment = NEW.id_comment AND id_user = NEW.id_user
        ) THEN
            RAISE EXCEPTION 'User has already liked this comment';
        END IF;
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER single_post_like_trigger
BEFORE INSERT ON post_like
FOR EACH ROW
EXECUTE FUNCTION prevent_duplicate_likes();

CREATE TRIGGER single_comment_like_trigger
BEFORE INSERT ON comment_like
FOR EACH ROW
EXECUTE FUNCTION prevent_duplicate_likes();

-- BR15: Post Content Requirement
CREATE FUNCTION check_post_content() RETURNS TRIGGER AS $$
BEGIN
    IF NEW.description IS NULL AND NEW.image IS NULL THEN
        RAISE EXCEPTION 'Post must have either a description or an image';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER post_content_trigger
BEFORE INSERT OR UPDATE ON post
FOR EACH ROW
EXECUTE FUNCTION check_post_content();








```
<a id="sqlb"></a>
#### A.2. Database population

 ```sql
BEGIN;


INSERT INTO registered_user (username, name, email, password, biography, profile_picture, is_public) VALUES
('hvegan', 'Hugo Vegano', 'hugo@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Adepto do veganismo e do fitness. Correr é vida! 🏃‍♂️', 'img/users/hugo.png', TRUE),
('ffrioli', 'Franchesco Frioli', 'franco@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Calcio, pasta e golo! Forza Italia! 🍕', 'img/users/franco.png', TRUE),
('acoutinho', 'André Coutinho', 'andre@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Programador de dia, basquetebolista à noite. 🏀', 'img/users/andre.png', TRUE),
('admin', 'Maria Silva (Admin)', 'admin@sportsnet.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'A manter a rede a funcionar.', 'img/users/admin.png', TRUE),
('cr7', 'Cristiano Ronaldo', 'cr7@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'SIUUUU! 🐐', 'img/users/cr7.png', TRUE),
('jmarques', 'Joana Marques', 'joana@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Amante de Padel e corridas de fim-de-semana.', 'img/users/joana.png', TRUE),
('rcosta', 'Rui Costa', 'rui@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Sempre a ver futebol.', 'img/users/rui.png', FALSE);


INSERT INTO administrator (id_admin) VALUES (4);
INSERT INTO verified_user (id_verified) VALUES (5);
INSERT INTO group_owner (id_group_owner) VALUES (1), (2), (6);


INSERT INTO label (designation, image) VALUES
('Futebol', 'img/labels/futebol.png'),
('Basquetebol', 'img/labels/basket.png'),
('Corrida', 'img/labels/running.png'),
('Padel', 'img/labels/padel.png'),
('Nutrição', 'img/labels/nutri.png'),
('Equipamento', 'img/labels/equip.png'),
('Ginásio', 'img/labels/gym.png');

INSERT INTO sport (id_sport) VALUES (1), (2), (3), (4), (7);
INSERT INTO category (id_category) VALUES (5), (6);


INSERT INTO user_label (id_user, id_label) VALUES
(1, 3), (1, 5), (2, 1), (3, 2), (5, 1), (5, 7), (6, 4), (6, 3);


INSERT INTO post (id_creator, image, description, date) VALUES
(5, 'img/posts/cr7_golo.jpg', 'Dia de jogo! Foco total. ⚽️ #Futebol #CR7', NOW() - INTERVAL '2 days'),
(1, 'img/posts/hugo_run.jpg', 'Mais 10km para começar o dia. A energia vegan a funcionar! 🏃‍♂️ #running #vegan', NOW() - INTERVAL '1 day'),
(3, 'img/posts/andre_basket.jpg', 'Grande jogo ontem com a malta! 🏀 #basketamador #LBAW', NOW() - INTERVAL '10 hours'),
(2, 'img/posts/franco_pizza.jpg', 'A preparar o pre-jogo! Non c''è partita senza una buona pizza. 🍕 #italia #futebol', NOW() - INTERVAL '5 hours'),
(5, 'img/posts/cr7_gym.jpg', 'Sem dias de folga. 💪 #gym #foco', NOW() - INTERVAL '3 hours'),
(6, 'img/posts/joana_padel.jpg', 'Manhã de Padel. Quem alinha para a próxima? #padel', NOW() - INTERVAL '1 hour');


INSERT INTO user_tag (id_post, id_user) VALUES
(3, 1), (4, 5);


INSERT INTO post_like (id_post, id_user) VALUES
(1, 1), (1, 2), (1, 3), (2, 3), (2, 6), (5, 1), (6, 1);

INSERT INTO post_save (id_post, id_user) VALUES
(2, 6), (5, 3);


INSERT INTO comments (id_post, id_user, id_reply, text, date) VALUES
(1, 2, NULL, 'Grande!! Il migliore del mondo! 🇮🇹', NOW() - INTERVAL '1 day'),
(2, 3, NULL, 'Boa Hugo! Eu fico-me pelo basket 😅', NOW() - INTERVAL '10 hours'),
(2, 1, 2, 'Obrigado André! Temos de combinar um treino um dia destes.', NOW() - INTERVAL '9 hours'),
(1, 1, NULL, 'Máquina! 🔥', NOW() - INTERVAL '8 hours'),
(6, 3, NULL, 'Eu alinho Joana!', NOW() - INTERVAL '30 minutes');


INSERT INTO comment_like (id_comment, id_user) VALUES
(1, 5), (1, 1), (2, 1), (5, 6);


INSERT INTO user_friend (id_user, id_friend) VALUES
(1, 3), (3, 1), (1, 6), (6, 1), (2, 5), (5, 2);

INSERT INTO user_friend_request (id_user, id_requester) VALUES
(1, 2), (7, 3);


INSERT INTO user_block (id_user, id_blocked) VALUES
(7, 5);


INSERT INTO groups (id_owner, name, description, picture, is_public) VALUES
(1, 'Vegan Runners PT', 'Grupo para partilhar corridas e receitas vegan.', 'img/groups/group_run.png', TRUE),
(2, 'Calcio Amatori 🇮🇹', 'Só para verdadeiros fãs da Serie A.', 'img/groups/group_calcio.png', TRUE),
(6, 'Padel LBAW', 'Grupo privado da malta de Padel.', 'img/groups/group_padel.png', TRUE);


INSERT INTO group_membership (id_group, id_member) VALUES
(1, 1), (1, 6), (2, 2), (2, 5), (3, 6);

INSERT INTO group_join_request (id_group, id_requester) VALUES
(3, 3);


INSERT INTO message (text, image, date) VALUES
('Olá André, tudo bem?', NULL, NOW() - INTERVAL '1 hour'),
('Tudo! E contigo? Vi o teu post da corrida, grande forma!', NULL, NOW() - INTERVAL '55 minutes'),
('Forza! Stasera si vince! ⚽️', 'img/msg/italia_flag.png', NOW() - INTERVAL '30 minutes'),
('Onde é o jogo de Padel amanhã?', NULL, NOW() - INTERVAL '10 minutes');


INSERT INTO private_message (id_message, id_sender, id_receiver) VALUES
(1, 1, 3), (2, 3, 1);

INSERT INTO group_message (id_message, id_group, id_sender) VALUES
(3, 2, 2), (4, 3, 6);


INSERT INTO notification (id_receiver, id_emitter, text, date) VALUES
(5, 1, 'Hugo Vegano gostou do seu post.', NOW() - INTERVAL '2 days'),
(1, 3, 'André Coutinho comentou o seu post.', NOW() - INTERVAL '10 hours'),
(3, 1, 'Hugo Vegano gostou do seu comentário.', NOW() - INTERVAL '9 hours'),
(1, 2, 'Franchesco Frioli enviou-lhe um pedido de amizade.', NOW() - INTERVAL '1 day'),
(3, 1, 'Hugo Vegano enviou-lhe uma mensagem.', NOW() - INTERVAL '1 hour'),
(5, 2, 'Nova mensagem no grupo ''Calcio Amatori 🇮🇹''.', NOW() - INTERVAL '30 minutes'),
(6, 3, 'André Coutinho quer juntar-se ao grupo ''Padel LBAW''.', NOW() - INTERVAL '5 minutes');


INSERT INTO like_post_notification (id_notification, id_post) VALUES (1, 1);
INSERT INTO comment_notification (id_notification, id_comment) VALUES (2, 2);
INSERT INTO like_comment_notification (id_notification, id_comment) VALUES (3, 2);
INSERT INTO friend_request_notification (id_notification, accepted) VALUES (4, NULL);
INSERT INTO private_message_notification (id_notification, id_message) VALUES (5, 1);
INSERT INTO group_message_notification (id_notification, id_message) VALUES (6, 3);
INSERT INTO join_group_request_notification (id_notification, id_group, accepted) VALUES (7, 3, NULL);


INSERT INTO report (description) VALUES
('Este comentário é spam e ofensivo.'),
('Este post é fake news sobre nutrição.');


INSERT INTO report_comment (id_report, id_comment) VALUES (1, 1);
INSERT INTO report_post (id_report, id_post) VALUES (2, 2);


COMMIT;
```



---




