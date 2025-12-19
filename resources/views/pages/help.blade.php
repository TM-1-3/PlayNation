@extends('layouts.app')

@section('title', 'Help & Support - PlayNation')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-6">
    
    <div class="text-center mb-16">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Frequently Asked Questions</h1>
        <p class="text-lg text-gray-500">Everything you need to know about the platform.</p>
    </div>

    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
            <i class="fa-solid fa-id-card text-blue-600"></i> Account & Verification
        </h2>
        
        <div class="space-y-4">
            <details class="group bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden cursor-pointer">
                <summary class="flex justify-between items-center p-5 font-bold text-gray-800 list-none">
                    <span class="flex items-center gap-3">
                        <i class="fa-solid fa-certificate text-blue-500"></i> What is a Verified User?
                    </span>
                    <span class="transition group-open:rotate-180"><i class="fa-solid fa-chevron-down text-gray-400"></i></span>
                </summary>
                <div class="px-5 pb-5 text-gray-600 text-sm leading-relaxed border-t border-gray-100 pt-4">
                    Verified Users represent official entities like <strong>athletes, teams, or content creators</strong>. Their role is marked by a blue checkmark badge, and they are the only ones who can post official announcements regarding schedules and results.
                </div>
            </details>

            <details class="group bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden cursor-pointer">
                <summary class="flex justify-between items-center p-5 font-bold text-gray-800 list-none">
                    <span class="flex items-center gap-3">
                        <i class="fa-solid fa-file-signature text-blue-500"></i> How do I become a Verified User?
                    </span>
                    <span class="transition group-open:rotate-180"><i class="fa-solid fa-chevron-down text-gray-400"></i></span>
                </summary>
                <div class="px-5 pb-5 text-gray-600 text-sm leading-relaxed border-t border-gray-100 pt-4">
                    The Verification Badge is reserved for official entities such as professional athletes, sports clubs, and recognized content creators. Please contact our administration for verification.
                </div>
            </details>

            <details class="group bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden cursor-pointer">
                <summary class="flex justify-between items-center p-5 font-bold text-gray-800 list-none">
                    <span class="flex items-center gap-3">
                        <i class="fa-solid fa-user-shield text-blue-500"></i> Public vs. Private Profile
                    </span>
                    <span class="transition group-open:rotate-180"><i class="fa-solid fa-chevron-down text-gray-400"></i></span>
                </summary>
                <div class="px-5 pb-5 text-gray-600 text-sm leading-relaxed border-t border-gray-100 pt-4">
                    According to our Business Rules, profiles can be <strong>Public</strong> or <strong>Private</strong>. A Private Profile ensures that your posts are only accessible to users you have explicitly accepted as friends. You can toggle this setting in your 'Edit Profile' page.
                </div>
            </details>

            <details class="group bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden cursor-pointer">
                <summary class="flex justify-between items-center p-5 font-bold text-gray-800 list-none">
                    <span class="flex items-center gap-3">
                        <i class="fa-solid fa-user-xmark text-red-500"></i> What happens if I delete my account?
                    </span>
                    <span class="transition group-open:rotate-180"><i class="fa-solid fa-chevron-down text-gray-400"></i></span>
                </summary>
                <div class="px-5 pb-5 text-gray-600 text-sm leading-relaxed border-t border-gray-100 pt-4">
                    Upon deletion, your login credentials are removed. However, shared data such as comments or likes may be kept in the system but will be <strong>anonymized</strong> to maintain the integrity of discussions.
                </div>
            </details>
        </div>
    </div>

    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
            <i class="fa-solid fa-users-rectangle text-blue-600"></i> Groups & Community
        </h2>

        <div class="space-y-4">
            <details class="group bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden cursor-pointer">
                <summary class="flex justify-between items-center p-5 font-bold text-gray-800 list-none">
                    <span class="flex items-center gap-3">
                        <i class="fa-solid fa-plus-circle text-blue-500"></i> Can I create my own community?
                    </span>
                    <span class="transition group-open:rotate-180"><i class="fa-solid fa-chevron-down text-gray-400"></i></span>
                </summary>
                <div class="px-5 pb-5 text-gray-600 text-sm leading-relaxed border-t border-gray-100 pt-4">
                    Yes! Any Authenticated User can become a <strong>Group Owner</strong>. You can create groups for specific topics. If the group is Private, you must approve every join request manually.
                </div>
            </details>

            <details class="group bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden cursor-pointer">
                <summary class="flex justify-between items-center p-5 font-bold text-gray-800 list-none">
                    <span class="flex items-center gap-3">
                        <i class="fa-solid fa-unlock-keyhole text-blue-500"></i> How do Group permissions work?
                    </span>
                    <span class="transition group-open:rotate-180"><i class="fa-solid fa-chevron-down text-gray-400"></i></span>
                </summary>
                <div class="px-5 pb-5 text-gray-600 text-sm leading-relaxed border-t border-gray-100 pt-4">
                    <p class="mb-2">Groups are the heart of specific sports discussions:</p>
                    <ul class="list-disc pl-5 space-y-2">
                        <li>
                            <span class="font-bold text-gray-800">Public Groups:</span> Visible to everyone. Join instantly to start posting.
                        </li>
                        <li>
                            <span class="font-bold text-gray-800">Private Groups:</span> Hidden from non-members. You must send a 'Join Request' to enter.
                        </li>
                    </ul> 
                </div>
            </details>

            <details class="group bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden cursor-pointer">
                <summary class="flex justify-between items-center p-5 font-bold text-gray-800 list-none">
                    <span class="flex items-center gap-3">
                        <i class="fa-solid fa-list-check text-blue-500"></i> Can I manage a group I created?
                    </span>
                    <span class="transition group-open:rotate-180"><i class="fa-solid fa-chevron-down text-gray-400"></i></span>
                </summary>
                <div class="px-5 pb-5 text-gray-600 text-sm leading-relaxed border-t border-gray-100 pt-4">
                    Yes. As a Group Owner, you can edit details, manage join requests for private groups, and remove members who violate rules.
                </div>
            </details>
        </div>
    </div>

    <div class="mb-16">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
            <i class="fa-solid fa-shield-cat text-blue-600"></i> Features & Safety
        </h2>

        <div class="space-y-4">
            <details class="group bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden cursor-pointer">
                <summary class="flex justify-between items-center p-5 font-bold text-gray-800 list-none">
                    <span class="flex items-center gap-3">
                        <i class="fa-solid fa-filter text-blue-500"></i> How can I filter content?
                    </span>
                    <span class="transition group-open:rotate-180"><i class="fa-solid fa-chevron-down text-gray-400"></i></span>
                </summary>
                <div class="px-5 pb-5 text-gray-600 text-sm leading-relaxed border-t border-gray-100 pt-4">
                    You can use Filters to narrow down results by specific modalities, teams, dates, or popularity (likes). This ensures you find exact matches without scrolling through unrelated content.
                </div>
            </details>

            <details class="group bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden cursor-pointer">
                <summary class="flex justify-between items-center p-5 font-bold text-gray-800 list-none">
                    <span class="flex items-center gap-3">
                        <i class="fa-regular fa-bell text-blue-500"></i> How do notifications work?
                    </span>
                    <span class="transition group-open:rotate-180"><i class="fa-solid fa-chevron-down text-gray-400"></i></span>
                </summary>
                <div class="px-5 pb-5 text-gray-600 text-sm leading-relaxed border-t border-gray-100 pt-4">
                    You receive real-time notifications for likes, comments, friend requests, and group activities. This keeps you updated on all interactions relevant to you.
                </div>
            </details>

            <details class="group bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden cursor-pointer">
                <summary class="flex justify-between items-center p-5 font-bold text-gray-800 list-none">
                    <span class="flex items-center gap-3">
                        <i class="fa-solid fa-ban text-red-500"></i> Prohibited Content & Moderation
                    </span>
                    <span class="transition group-open:rotate-180"><i class="fa-solid fa-chevron-down text-gray-400"></i></span>
                </summary>
                <div class="px-5 pb-5 text-gray-600 text-sm leading-relaxed border-t border-gray-100 pt-4">
                    We have a zero-tolerance policy for hate speech or violence. Administrators review reports and have the authority to ban users who violate our Community Guidelines.
                </div>
            </details>
        </div>
    </div>

    <div class="mb-16">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
            <i class="fa-solid fa-hand-pointer text-blue-600"></i> Usability & Interactions
        </h2>

        <div class="space-y-4">
            
            <details class="group bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden cursor-pointer">
                <summary class="flex justify-between items-center p-5 font-bold text-gray-800 list-none">
                    <span class="flex items-center gap-3">
                        <i class="fa-solid fa-user-plus text-blue-500"></i> Do I "Follow" users or add "Friends"?
                    </span>
                    <span class="transition group-open:rotate-180"><i class="fa-solid fa-chevron-down text-gray-400"></i></span>
                </summary>
                <div class="px-5 pb-5 text-gray-600 text-sm leading-relaxed border-t border-gray-100 pt-4">
                    PlayNation operates on a <strong>Friendship</strong> model. Unlike a one-way "Follow", you must send a Friend Request, which the other user must accept. This ensures that Private Profiles remain truly private and secure.
                </div>
            </details>

            <details class="group bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden cursor-pointer">
                <summary class="flex justify-between items-center p-5 font-bold text-gray-800 list-none">
                    <span class="flex items-center gap-3">
                        <i class="fa-regular fa-paper-plane text-blue-500"></i> How does sharing posts to chat work?
                    </span>
                    <span class="transition group-open:rotate-180"><i class="fa-solid fa-chevron-down text-gray-400"></i></span>
                </summary>
                <div class="px-5 pb-5 text-gray-600 text-sm leading-relaxed border-t border-gray-100 pt-4">
                    When you use the "Share" button on a post, our system doesn't just send a link. It generates a <strong>Smart Content Card</strong> within the conversation. This allows the recipient to see a preview of the photo and author instantly without leaving the chat.
                </div>
            </details>

            <details class="group bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden cursor-pointer">
                <summary class="flex justify-between items-center p-5 font-bold text-gray-800 list-none">
                    <span class="flex items-center gap-3">
                        <i class="fa-solid fa-eye-slash text-gray-500"></i> Why does a post say "Content Unavailable"?
                    </span>
                    <span class="transition group-open:rotate-180"><i class="fa-solid fa-chevron-down text-gray-400"></i></span>
                </summary>
                <div class="px-5 pb-5 text-gray-600 text-sm leading-relaxed border-t border-gray-100 pt-4">
                    If someone shares a post with you from a <strong>Private Group</strong> or a <strong>Private Profile</strong> that you are not connected with, the system protects that content. You must join the group or become friends with the author to view it.
                </div>
            </details>

        </div>
    </div>

    <div class="bg-blue-600 rounded-2xl p-8 text-white text-center shadow-lg">
        <h3 class="text-xl font-bold mb-4">Contact the Developers</h3>
        <p class="mb-6 opacity-90 text-sm">For technical issues or feature requests, reach out to Group 2551.</p>
        <div class="inline-flex bg-blue-700 px-6 py-3 rounded-lg items-center gap-3 border border-blue-500 hover:bg-blue-800 transition">
            <i class="fa-solid fa-envelope"></i>
            <a href="mailto:up202304692@edu.fe.up.pt" class="text-white no-underline font-semibold">
                support@email.com
            </a>
        </div>
    </div>

</div>
@endsection