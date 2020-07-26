<template>
    <div id="frame">
	<div id="sidepanel">
		<div id="profile">
			<div class="wrap">
				<img id="profile-img" src="/images/me.png" class="online" alt="" />
				<p>{{user.name}}</p>
				
				
				
			</div>
		</div>
		<div id="search">
			<label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
			<input type="text" placeholder="Search contacts..." />
		</div>
		<div id="contacts">
			<ul>
				<li v-on:click='changeFriend(friend.user.id,friend.user.name)' class="contact" :class="getActiveUserClass(friend.user.id)" :key="friend.user.id" v-for="friend in friends">
					<div class="wrap">
						<img src="/images/user.png" style="width:30px" alt="" />
						<div class="meta">
							<p class="name">{{friend.user.name}}</p>
						</div>
					</div>
				</li>
				
			</ul>
		</div>
		
	</div>
	<div class="content">
		<div class="contact-profile">
			<p>{{this.selectedUser.name}}</p>
		</div>
		<div class="messages">
			<ul style="width:100%;">
				<li :key="message.id" v-for="message in messages" :class="getMessageClass(message)">
					<img src="/images/user.png" style="width:30px" alt="" />
					<p>{{message.message}}</p>
				</li>
				
				
			</ul>
		</div>
		<div class="message-input">
			<div class="wrap">
			<input v-on:keyup.enter="sentMessage" type="text" v-model="messageObject.message" placeholder="Write your message..." />
			<i class="fa fa-paperclip attachment" aria-hidden="true"></i>
			<button v-on:click='sentMessage' class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
			</div>
		</div>
	</div>
</div>
</template>

<script>

    export default {
        props: {
            'user': {
                type: Object,
            }
        },
        data() { 
            return{
            friends: [],
            selectedUser: {
                id: '',
                name: '',
            },
            messageObject: {
                id: null,
                from: this.user.id,
                to: null,
                message: '',
            },
            messages: [],
            csrf_token : $('meta[name="csrf-token"]').attr('content'),
            };
    },
    methods: {
        changeFriend: function($id,$name)
        {
            //if the user id does not match with the selected user then refetch the messages other wise do nothing.
            if($id != this.selectedUser.id)
            {
                this.selectedUser.id = $id;
                this.selectedUser.name = $name;
                this.messages = [];
                this.getMessages();
                
            }
          
        },
        getActiveUserClass: function(id)
        {
            return this.selectedUser.id == id ? "active":"";
        },
        getMessageClass: function(item)
        {
            return item.from == this.user.id? "sent":"replies";
            
        },
        getMessages: function ()
        {
                const requestOptions = {
                method: "GET",
                };
                fetch("message/"+this.selectedUser.id, requestOptions)
                .then(response => response.json())
                .then(data => {
                   data.status == true? this.messages = data.data: null;
                $(".messages").animate({ scrollTop: $(document).height() }, "fast");
                });
        },
        sentMessage: function()
        {
            if(this.messageObject.message != ""){
            //sending a message to the route
            this.messageObject.to = this.selectedUser.id;
             const requestOptions = {
                    method: "POST",
                    headers: { 
                    "Content-Type": "application/json",
                    'X-CSRF-TOKEN': this.csrf_token 
                    },
                    body: JSON.stringify(this.messageObject)
                };

                fetch("message", requestOptions)
                .then(response => response.json())
                .then(data => {
                    if(data.status){
                        this.messages.push(data.data);
                        this.messageObject.message = '';
                        $(".messages").animate({ scrollTop: $(document).height() }, "fast");
                    }
                    else{
                        this.messageObject.message = 'Something wents wrong';
                    }
                    
                });
            }
        }
    },
    created() {
        //getting user friends, first friend messages
               
                const requestOptions = {
                method: "GET",
                };

                fetch("friend", requestOptions)
                .then(response => response.json())
                .then(data => {
                    if(data.status){
                    this.friends = data.data;
                    this.selectedUser.id = data.data[0].user.id;
                    this.selectedUser.name = data.data[0].user.name;
                    fetch("message/"+this.selectedUser.id, requestOptions)
                    .then(response => response.json())
                    .then(data => {
                    data.status == true? this.messages = data.data: null;
                    $(".messages").animate({ scrollTop: $('.message').prop("scrollHeight") }, "fast");
                });
                    }
                    
                });
                
     },
     mounted(){
         //listening to events
        Echo.private('chat.'+this.user.id) //Should be Channel Name
        .listen('.NewMessageNotification', (e) => {
           if(this.selectedUser.id == e.message.from)
             {
                 this.messages.push(e.message);
                 $(".messages").animate({ scrollTop: $('.message').prop("scrollHeight") }, "fast");
             }
             else{
                 alert(this.friends.find(x => x.user.id === e.message.from).user.name + " has messaged you");
             }
        });
    }
    
    }
</script>
