screen_helper="""
ScreenManager:
	MainScreen:
	SearchTicketScreen:
	SignUpScreen:
	AdminScreen:
	AdminSearchTicketScreen:
	AdminSignUpScreen:
	ManageBusScreen:
	AddBusScreen:
	ShowTicketScreen:
	TicketScreen:
	AdminShowTicketScreen:
	AdminTicketScreen:
	AdminResetBus:
<MainScreen>:
	name: 'main'
	MDScreen :
		#md_bg_color : [2/255,69/255,208/255,1]
		Image:     # This part doesn't seem to work
            source: "bg.jpg"
            allow_stretch: True
            keep_ratio: False
            size_hint: 1, 1
		MDCard :
			size_hint : None,None
			size : 320,600
			pos_hint : {"center_x":.5,"center_y":.5}
			elevation : 5
			md_bg_color : [240/255,240/255,247/255,1]
			padding : 5
			spacing : 5
			orientation : "vertical"
			# Adding items to the card
			MDLabel :
				text : 'Bus Ticket Booking System-> Login for Purchase Ticket'
				font_style : 'Button'
				font_size : 30
				halign : "center"
				size_hint_y : None
				height : self.texture_size[1]
				padding_y : 10
			
			MDTextField :
				hint_text : "user-id"
				id: userid
				icon_right : "account"
				size_hint_x : None
				width : 220
				font_size : 20
				pos_hint : {"center_x":.5}
				color_active : [1,1,1,1]
			MDTextField :
				hint_text : "password"
				id: password
				icon_right : "eye-off"
				size_hint_x : None
				id: password
				width : 220
				font_size : 20
				pos_hint : {"center_x":.5}
				color_active : [1,1,1,1]
				password : True
			MDTextField :
				hint_text : "Role : user/admin"
				id: role
				size_hint_x : None
				width : 220
				font_size : 20
				pos_hint : {"center_x":.5}
				color_active : [1,1,1,1]
				
			MDLabel :
				text : ""
				id: msg
				font_style : "Button"
				font_size : 15
				halign : "center"
				size_hint_y : None
				height : self.texture_size[1]
				padding_y : 10
			BoxLayout:
				orientation: "horizontal"
				size: root.width, root.height
				spacing:30
				MDRoundFlatButton :
					text : 'Login'
					pos_hint : {"center_x":.4}
					font_size : 15
					padding_y:30
					on_press: root.do_login(userid.text,password.text,role.text)
					#on_press: root.manager.current='admin'
				MDRoundFlatButton :
					text : 'Sign-Up'
					pos_hint : {"center_x":.6}
					font_size : 15
					padding_y:30
					on_press: root.manager.current='singup'
						
						
			Widget :
				size_hint_y : None
				height : 30
<SearchTicketScreen>:
	name: 'search'
	MDScreen :
		#md_bg_color : [2/255,69/255,208/255,1]
		Image:     # This part doesn't seem to work
            source: "bg.jpg"
            allow_stretch: True
            keep_ratio: False
            size_hint: 1, 1

		MDCard :
			size_hint : None,None
			size : 320,600
			pos_hint : {"center_x":.5,"center_y":.5}
			elevation : 5
			md_bg_color : [240/255,240/255,247/255,1]
			padding : 15
			spacing : 30
			orientation : "vertical"
			# Adding items to the card
			
			MDLabel :
				text : 'Bus Ticket Booking System-> Search Ticket'
				font_style : 'Button'
				font_size : 20
				halign : "center"
				size_hint_y : None
				height : self.texture_size[1]
				padding_y : 15
			MDTextField :
				hint_text : "From Station"
				id: fromstation
				size_hint_x : None
				width : 220
				font_size : 20
				pos_hint : {"center_x":.5}
				color_active : [1,1,1,1]
			MDTextField :
				hint_text : "To Station"
				size_hint_x : None
				id: destinationstation
				width : 220
				font_size : 20
				pos_hint : {"center_x":.5}
				color_active : [1,1,1,1]
			MDTextField :
				hint_text : "Date[DD-MM-YYYY]"
				id: date
				size_hint_x : None
				width : 220
				font_size : 20
				pos_hint : {"center_x":.5}
				color_active : [1,1,1,1]
			MDLabel :
				text : ""
				id: msg
				font_style : "Button"
				font_size : 15
				halign : "center"
				size_hint_y : None
				height : self.texture_size[1]
				padding_y : 10
			BoxLayout:
				orientation: "horizontal"
				size: root.width, root.height
				spacing:5
				MDRoundFlatButton :
					text : 'Search Ticket'
					pos_hint : {"center_x":.4}
					font_size : 15
					spacing:30
					on_press: root.do_search()
				MDRoundFlatButton :
					text : 'Log Out'
					pos_hint : {"center_x":.6}
					font_size : 15
					on_press: root.manager.current= 'main'
					#on_press: root.do_signup()
<AdminSearchTicketScreen>:
	name: 'searchadmin'
	MDScreen :
		#md_bg_color : [2/255,69/255,208/255,1]
		Image:     # This part doesn't seem to work
            source: "bg.jpg"
            allow_stretch: True
            keep_ratio: False
            size_hint: 1, 1

		MDCard :
			size_hint : None,None
			size : 320,600
			pos_hint : {"center_x":.5,"center_y":.5}
			elevation : 5
			md_bg_color : [240/255,240/255,247/255,1]
			padding : 15
			spacing : 30
			orientation : "vertical"
			# Adding items to the card
			MDLabel :
				text : 'Bus Ticket Booking System-> Search Ticket'
				font_style : 'Button'
				font_size : 20
				halign : "center"
				size_hint_y : None
				height : self.texture_size[1]
				padding_y : 15
			MDTextField :
				hint_text : "From Station"
				id: fromstation
				size_hint_x : None
				width : 220
				font_size : 20
				pos_hint : {"center_x":.5}
				color_active : [1,1,1,1]
			MDTextField :
				hint_text : "To Station"
				size_hint_x : None
				id: destinationstation
				width : 220
				font_size : 20
				pos_hint : {"center_x":.5}
				color_active : [1,1,1,1]
			MDTextField :
				hint_text : "Date[DD-MM-YYYY]"
				id: date
				size_hint_x : None
				width : 220
				font_size : 20
				pos_hint : {"center_x":.5}
				color_active : [1,1,1,1]
			MDLabel :
				text : ""
				id: msg
				font_style : "Button"
				font_size : 15
				halign : "center"
				size_hint_y : None
				height : self.texture_size[1]
				padding_y : 10
			BoxLayout:
				orientation: "horizontal"
				size: root.width, root.height
				spacing:5
				MDRoundFlatButton :
					text : 'Back'
					pos_hint : {"center_x":.6}
					font_size : 15
					on_press: root.manager.current='admin'
				MDRoundFlatButton :
					text : 'Search Ticket'
					pos_hint : {"center_x":.4}
					font_size : 15
					spacing:30
					#on_press: root.manager.current = 'main'
					on_press: root.do_search1()
				MDRoundFlatButton :
					text : 'Log Out'
					pos_hint : {"center_x":.6}
					font_size : 15
					on_press: root.manager.current= 'main'
					#on_press: root.do_signup()
<SignUpScreen>:
	name: 'singup'
	MDScreen :
		#md_bg_color : [2/255,69/255,208/255,1]
		Image:     # This part doesn't seem to work
            source: "bg.jpg"
            allow_stretch: True
            keep_ratio: False
            size_hint: 1, 1

		MDCard :
			size_hint : None,None
			size : 320,600
			pos_hint : {"center_x":.5,"center_y":.5}
			elevation : 5
			md_bg_color : [240/255,240/255,247/255,1]
			padding : 5
			spacing : 5
			orientation : "vertical"
			# Adding items to the card
			MDLabel :
				text : "Bus Ticket Booking System -> Sign up"
				font_style : "Button"
				font_size : 30
				halign : "center"
				size_hint_y : None
				height : self.texture_size[1]
				padding_y : 10
			
			MDTextField: 
				hint_text : "user-id"
				id : userid
				size_hint_x : None
				icon_right : "account"
				width : 270
				font_size : 20
				pos_hint : {"center_x":.5}
				normal_color : [35/255,49/255,48/255,1]
				color_active : [1,1,1,1]
			MDTextField: 
				hint_text : "password"
				id: password
				password : True
				size_hint_x : None
				icon_right : "eye-off"
				width : 270
				font_size : 20
				pos_hint : {"center_x":.5}
				normal_color : [35/255,49/255,48/255,1]
				color_active : [1,1,1,1]
			MDTextField: 
				hint_text : "confirm-password"
				id: cpassword
				size_hint_x : None
				password : True
				icon_right : "eye-off"
				width : 270
				font_size : 20
				pos_hint : {"center_x":.5}
				normal_color : [35/255,49/255,48/255,1]
				color_active : [1,1,1,1]
			MDTextField: 
				hint_text : "mobile number"
				id: mobile
				size_hint_x : None
				icon_right : "phone"
				width : 270
				font_size : 20
				pos_hint : {"center_x":.5}
				normal_color : [35/255,49/255,48/255,1]
				color_active : [1,1,1,1]
			MDLabel :
				text : ""
				id: msg
				font_style : "Button"
				font_size : 15
				halign : "center"
				size_hint_y : None
				height : self.texture_size[1]
				padding_y : 10
			BoxLayout:
				orientation: "horizontal"
				size: root.width, root.height
				spacing:5
				MDRoundFlatButton :
					text : 'Back'
					pos_hint : {"center_x":.4}
					font_size : 15
					spacing:30
					on_press: root.manager.current = 'main'
				MDRoundFlatButton :
					text : 'Sign-Up'
					pos_hint : {"center_x":.6}
					font_size : 15
					on_press: root.do_signup()
					#on_press: root.do_signup()
<AdminSignUpScreen>:
	name: 'signupadmin'
	MDScreen :
		#md_bg_color : [2/255,69/255,208/255,1]
		Image:     # This part doesn't seem to work
            source: "bg.jpg"
            allow_stretch: True
            keep_ratio: False
            size_hint: 1, 1

		MDCard :
			size_hint : None,None
			size : 320,600
			pos_hint : {"center_x":.5,"center_y":.5}
			elevation : 5
			md_bg_color : [240/255,240/255,247/255,1]
			padding : 5
			spacing : 5
			orientation : "vertical"
			# Adding items to the card
			MDLabel :
				text : "Bus Ticket Booking System -> Add admin"
				font_style : "Button"
				font_size : 30
				halign : "center"
				size_hint_y : None
				height : self.texture_size[1]
				padding_y : 10
			
			MDTextField: 
				hint_text : "user-id"
				id : userid
				size_hint_x : None
				icon_right : "account"
				width : 270
				font_size : 20
				pos_hint : {"center_x":.5}
				normal_color : [35/255,49/255,48/255,1]
				color_active : [1,1,1,1]
			MDTextField: 
				hint_text : "password"
				id: password
				password : True
				size_hint_x : None
				icon_right : "eye-off"
				width : 270
				font_size : 20
				pos_hint : {"center_x":.5}
				normal_color : [35/255,49/255,48/255,1]
				color_active : [1,1,1,1]
			MDTextField: 
				hint_text : "confirm-password"
				id: cpassword
				size_hint_x : None
				password : True
				icon_right : "eye-off"
				width : 270
				font_size : 20
				pos_hint : {"center_x":.5}
				normal_color : [35/255,49/255,48/255,1]
				color_active : [1,1,1,1]
			MDTextField: 
				hint_text : "mobile number"
				id: mobile
				size_hint_x : None
				icon_right : "phone"
				width : 270
				font_size : 20
				pos_hint : {"center_x":.5}
				normal_color : [35/255,49/255,48/255,1]
				color_active : [1,1,1,1]
			MDLabel :
				text : ""
				id: msg
				font_style : "Button"
				font_size : 15
				halign : "center"
				size_hint_y : None
				height : self.texture_size[1]
				padding_y : 10
			BoxLayout:
				orientation: "horizontal"
				size: root.width, root.height
				spacing:5
				MDRoundFlatButton :
					text : 'Back'
					pos_hint : {"center_x":.6}
					font_size : 15
					on_press: root.manager.current='admin'
				MDRoundFlatButton :
					text : 'Add'
					pos_hint : {"center_x":.4}
					font_size : 15
					spacing:30
					on_press: root.do_signup()
				MDRoundFlatButton :
					text : 'Log Out'
					pos_hint : {"center_x":.6}
					font_size : 15
					on_press: root.manager.current= 'main'
					#on_press: root.do_signup()

<AdminScreen>:
	name: 'admin'
	MDScreen :
		#md_bg_color : [2/255,69/255,208/255,1]
		Image:     # This part doesn't seem to work
            source: "bg.jpg"
            allow_stretch: True
            keep_ratio: False
            size_hint: 1, 1

		MDCard :
			size_hint : None,None
			size : 320,600
			pos_hint : {"center_x":.5,"center_y":.5}
			elevation : 5
			md_bg_color : [240/255,240/255,247/255,1]
			padding : 40
			spacing : 30
			orientation : "vertical"
			# Adding items to the card
			MDLabel :
				text : 'Bus Ticket Booking System-> Admin Panel'
				font_style : 'Button'
				font_size : 20
				halign : "center"
				size_hint_y : None
				height : self.texture_size[1]
				padding_y : 10
			MDRoundFlatButton :
				text : 'Manage Bus Ticket'
				pos_hint : {"center_x":.5}
				font_size : 15
				padding_y:30
				on_press: root.manager.current='searchadmin'
			MDRoundFlatButton :
				text : 'Manage Bus & Schedule'
				pos_hint : {"center_x":.5}
				font_size : 15
				padding_y:30
				on_press: root.manager.current= 'managebus'
			
			MDRoundFlatButton :
				text : 'Manage System Admin'
				pos_hint : {"center_x":.5}
				font_size : 15
				padding_y:30
				on_press: root.manager.current='signupadmin'
			BoxLayout:
				orientation: "horizontal"
				size: root.width, root.height
				spacing:5
				MDRoundFlatButton :
					text : 'Back'
					pos_hint : {"center_x":.5}
					font_size : 15
					padding_y:30
					on_press: root.manager.current= 'main'
				MDRoundFlatButton :
					text : 'Log Out'
					pos_hint : {"center_x":.5}
					font_size : 15
					padding_y:30
					on_press: root.manager.current= 'main'			
				Widget :
					size_hint_y : None
					height : 30
<ManageBusScreen>:
	name: 'managebus'
	MDScreen :
		#md_bg_color : [2/255,69/255,208/255,1]
		Image:     # This part doesn't seem to work
            source: "bg.jpg"
            allow_stretch: True
            keep_ratio: False
            size_hint: 1, 1

		MDCard :
			size_hint : None,None
			size : 320,600
			pos_hint : {"center_x":.5,"center_y":.5}
			elevation : 5
			md_bg_color : [240/255,240/255,247/255,1]
			padding : 40
			spacing : 30
			orientation : "vertical"
			# Adding items to the card
			MDLabel :
				text : 'Manage Bus & Schedule'
				font_style : 'Button'
				font_size : 20
				halign : "center"
				size_hint_y : None
				height : self.texture_size[1]
				padding_y : 10
			MDRoundFlatButton :
				text : 'Add Bus'
				pos_hint : {"center_x":.5}
				font_size : 15
				padding_y:30
				on_press: root.manager.current='addbus'
			MDRoundFlatButton :
				text : 'Reset Bus'
				pos_hint : {"center_x":.5}
				font_size : 15
				padding_y:30
				on_press: root.do_reset1()
				
			BoxLayout:
				orientation: "horizontal"
				size: root.width, root.height
				spacing:5
				MDRoundFlatButton :
					text : 'Back'
					pos_hint : {"center_x":.5}
					font_size : 15
					padding_y:30
					on_press: root.manager.current= 'admin'
				MDRoundFlatButton :
					text : 'Log Out'
					pos_hint : {"center_x":.5}
					font_size : 15
					padding_y:30
					on_press: root.manager.current= 'main'			
				Widget :
					size_hint_y : None
					height : 30
					
<AddBusScreen>:
	name: 'addbus'
	MDScreen :
		#md_bg_color : [2/255,69/255,208/255,1]
		Image:     # This part doesn't seem to work
            source: "bg.jpg"
            allow_stretch: True
            keep_ratio: False
            size_hint: 1, 1
		
		MDCard :
			orientation : 'vertical'
			size_hint : None,None
			size : 400,600
			pos_hint : {"center_x":.5,"center_y":.5}
			elevation : 5
			md_bg_color : [240/255,240/255,247/255,1]
			padding : 5
			spacing : 5
			MDLabel :
				text : "BTBS -> Add Bus"
				font_style : "Button"
				font_size : 30
				halign : "center"
				size_hint_y : None
				height : self.texture_size[1]
			
			MDTextField: 
				hint_text : "Bus No."
				size_hint_x : None
				id: busno
				width : 270
				font_size : 15
				pos_hint : {"center_x":.5}
				normal_color : [35/255,49/255,48/255,1]
				color_active : [1,1,1,1]
			MDTextField: 
				hint_text : "Bus Name"
				id: busname
				size_hint_x : None
				width : 270
				font_size : 15
				pos_hint : {"center_x":.5}
				normal_color : [35/255,49/255,48/255,1]
				color_active : [1,1,1,1]
			MDTextField: 
				hint_text : "From"
				size_hint_x : None
				id: fromstation
				width : 270
				font_size : 15
				pos_hint : {"center_x":.5}
				normal_color : [35/255,49/255,48/255,1]
				color_active : [1,1,1,1]
			MDTextField: 
				hint_text : "Destination"
				size_hint_x : None
				id: destinationstation
				width : 270
				font_size : 15
				pos_hint : {"center_x":.5}
				normal_color : [35/255,49/255,48/255,1]
				color_active : [1,1,1,1]
			MDTextField: 
				hint_text : "Total Seat"
				size_hint_x : None
				id: totalseat
				width : 270
				font_size : 15
				pos_hint : {"center_x":.5}
				normal_color : [35/255,49/255,48/255,1]
				color_active : [1,1,1,1]
			MDTextField: 
				hint_text : "Taka"
				size_hint_x : None
				id: taka
				width : 270
				font_size : 15
				pos_hint : {"center_x":.5}
				normal_color : [35/255,49/255,48/255,1]
				color_active : [1,1,1,1]
			MDTextField: 
				hint_text : "Date &Time[DD-MM-YYYY-HH.MM(AM/PM)]"
				size_hint_x : None
				id: datetime
				width : 270
				font_size : 15
				pos_hint : {"center_x":.5}
				normal_color : [35/255,49/255,48/255,1]
				color_active : [1,1,1,1]

			MDLabel :
				text : ""
				id: msg
				font_style : "Button"
				font_size : 15
				halign : "center"
				size_hint_y : None
				height : self.texture_size[1]
				padding_y : 5
			BoxLayout:
				orientation: "horizontal"
				size: root.width, root.height
				spacing:10
				MDRoundFlatButton :
					text : 'Back'
					pos_hint : {"center_x":.5}
					font_size : 15
					padding_y:10
					on_press: root.manager.current= 'managebus'
				MDRoundFlatButton :
					text : 'Submit'
					pos_hint : {"center_x":.5}
					font_size : 15
					padding_y:10
					on_press: root.do_submit()
				MDRoundFlatButton :
					text : 'Log Out'
					pos_hint : {"center_x":.5}
					font_size : 15
					padding_y:10
					on_press: root.manager.current= 'main'			
				
<ShowTicketScreen>:
	name: 'showticket'
	MDScreen :
		#md_bg_color : [2/255,69/255,208/255,1]
		Image:     # This part doesn't seem to work
            source: "bg.jpg"
            allow_stretch: True
            keep_ratio: False
            size_hint: 1, 1

		
		MDLabel :
			text : "BusNo  |  Bus Name |  From | Destination  |  AvailableSeat |  Taka  |  Date&Time"
			id: msg
			padding_y:10
			pos_hint:{"center_y":0.9}
			spacing: 10
			font_style : "Button"
			font_size : 15
			halign : "center"
		MDLabel:
			text:""
			padding_y:10
			pos_hint:{"center_y":0.8}
			id: msg1
			font_style : "Button"
			font_size : 15
			halign : "center"
		MDLabel:
			text:""
			padding_y:10
			pos_hint:{"center_y":0.7}
			id: msg0
			font_style : "Button"
			font_size : 15
			halign : "center"
		BoxLayout:
			orientation: "vertical"
			size: root.width, root.height
			pos_hint : {"center_x":.5,"center_y":.8}
			spacing:5
			MDTextField: 
				hint_text : "Bus No"
				size_hint_x : None
				id: busno 
				mode: "fill"
				fill_color: 0, 0, 0, 0
				width : 270
				font_size : 10
				pos_hint : {"center_x":.5,"center_y":.6}
				normal_color : [35/255,49/255,48/255,1]
				color_active : [1,1,1,1]
			MDTextField: 
				hint_text : "Quantity of Ticket"
				size_hint_x : None
				id: quantity
				mode: "fill"
				fill_color: 0, 0, 0, 0
				width : 270
				font_size : 10
				pos_hint : {"center_x":.5,"center_y":.5}
				normal_color : [35/255,49/255,48/255,1]
				color_active : [1,1,1,1]

		MDRoundFlatButton :
			text : 'Back'
			pos_hint : {"center_x":.1}
			font_size : 15
			padding_y:10
			on_press: root.manager.current= 'search'
			

		
		MDRoundFlatButton :
			text : 'Log Out'
			pos_hint : {"center_x":.5}
			font_size : 15
			on_press: root.manager.current= 'main'
		MDRoundFlatButton :
			text : 'Purchase'
			pos_hint : {"center_x":.9}
			font_size : 15
			on_press: root.do_purchase1()
			
<AdminShowTicketScreen>:
	name: 'adminshowticket'
	MDScreen :
		#md_bg_color : [2/255,69/255,208/255,1]
		Image:     # This part doesn't seem to work
            source: "bg.jpg"
            allow_stretch: True
            keep_ratio: False
            size_hint: 1, 1

		
		MDLabel :
			text : "BusNo  |  Bus Name |  From | Destination  |  AvailableSeat |  Taka  |  Date&Time"
			id: msg
			padding_y:10
			pos_hint:{"center_y":0.9}
			spacing: 10
			font_style : "Button"
			font_size : 15
			halign : "center"
		MDLabel:
			text:""
			padding_y:10
			pos_hint:{"center_y":0.8}
			id: msg1
			font_style : "Button"
			font_size : 15
			halign : "center"
		MDLabel:
			text:""
			padding_y:10
			pos_hint:{"center_y":0.7}
			id: msg0
			font_style : "Button"
			font_size : 15
			halign : "center"
		BoxLayout:
			orientation: "vertical"
			size: root.width, root.height
			pos_hint : {"center_x":.5,"center_y":.8}
			spacing:5
			MDTextField: 
				hint_text : "Bus No"
				size_hint_x : None
				id: busno 
				mode: "fill"
				fill_color: 0, 0, 0, 0
				width : 270
				font_size : 10
				pos_hint : {"center_x":.5,"center_y":.6}
				normal_color : [35/255,49/255,48/255,1]
				color_active : [1,1,1,1]
			MDTextField: 
				hint_text : "Quantity of Ticket"
				size_hint_x : None
				id: quantity
				mode: "fill"
				fill_color: 0, 0, 0, 0
				width : 270
				font_size : 10
				pos_hint : {"center_x":.5,"center_y":.5}
				normal_color : [35/255,49/255,48/255,1]
				color_active : [1,1,1,1]

		MDRoundFlatButton :
			text : 'Back'
			pos_hint : {"center_x":.1}
			font_size : 15
			padding_y:10
			on_press: root.manager.current= 'searchadmin'
			

		
		MDRoundFlatButton :
			text : 'Log Out'
			pos_hint : {"center_x":.5}
			font_size : 15
			on_press: root.manager.current= 'main'
		MDRoundFlatButton :
			text : 'Purchase'
			pos_hint : {"center_x":.9}
			font_size : 15
			on_press: root.do_purchase()
			
			
<AdminResetBus>:
	name: 'adminresetbus'
	MDScreen :
		#md_bg_color : [2/255,69/255,208/255,1]
		Image:     # This part doesn't seem to work
            source: "bg.jpg"
            allow_stretch: True
            keep_ratio: False
            size_hint: 1, 1

		
		MDLabel :
			text : "BusNo  |  Bus Name |  From | Destination  |  AvailableSeat |  Taka  |  Date&Time"
			id: msg
			padding_y:10
			pos_hint:{"center_y":0.9}
			spacing: 10
			font_style : "Button"
			font_size : 15
			halign : "center"
		MDLabel:
			text:""
			padding_y:10
			pos_hint:{"center_y":0.8}
			id: msg1
			font_style : "Button"
			font_size : 15
			halign : "center"
		MDLabel:
			text:""
			padding_y:10
			pos_hint:{"center_y":0.7}
			id: msg0
			font_style : "Button"
			font_size : 15
			halign : "center"
		BoxLayout:
			orientation: "horizontal"
			size: root.width, root.height
			pos_hint : {"center_x":.7,"center_y":.4}
			spacing:5
			MDTextField: 
				hint_text : "Bus No"
				size_hint_x : None
				id: busno 
				mode: "fill"
				fill_color: 0, 0, 0, 0
				width : 280
				font_size : 10
				pos_hint : {"center_x":.5,"center_y":.5}
				normal_color : [35/255,49/255,48/255,1]
				color_active : [1,1,1,1]
			MDTextField: 
				hint_text : "Date&Time[DD-MM-YYYY-HH.MM(AM/PM)]"
				size_hint_x : None
				id: date
				mode: "fill"
				fill_color: 0, 0, 0, 0
				width : 280
				font_size : 10
				pos_hint : {"center_x":.8,"center_y":.5}
				normal_color : [35/255,49/255,48/255,1]
				color_active : [1,1,1,1]
		BoxLayout:
			orientation: "horizontal"
			size: root.width, root.height
			pos_hint : {"center_x":.7,"center_y":.3}
			spacing:5
			MDTextField: 
				hint_text : "From Station"
				size_hint_x : None
				id: fromstation 
				mode: "fill"
				fill_color: 0, 0, 0, 0
				width : 280
				font_size : 10
				pos_hint : {"center_x":.5,"center_y":.5}
				normal_color : [35/255,49/255,48/255,1]
				color_active : [1,1,1,1]
			MDTextField: 
				hint_text : "Destination Station"
				size_hint_x : None
				id: destinationstation
				mode: "fill"
				fill_color: 0, 0, 0, 0
				width : 280
				font_size : 10
				pos_hint : {"center_x":.8,"center_y":.5}
				normal_color : [35/255,49/255,48/255,1]
				color_active : [1,1,1,1]

		MDRoundFlatButton :
			text : 'Back'
			pos_hint : {"center_x":.1}
			font_size : 15
			padding_y:10
			on_press: root.manager.current= 'managebus'
			

		
		MDRoundFlatButton :
			text : 'Log Out'
			pos_hint : {"center_x":.5}
			font_size : 15
			on_press: root.manager.current= 'main'
		MDRoundFlatButton :
			text : 'Reset'
			pos_hint : {"center_x":.9}
			font_size : 15
			on_press: root.do_reset()
			
<TicketScreen>:
	name: 'ticket'
	MDScreen :
		#md_bg_color : [2/255,69/255,208/255,1]
		Image:     # This part doesn't seem to work
            source: "bg.jpg"
            allow_stretch: True
            keep_ratio: False
            size_hint: 1, 1
			opacity: 0.5
		
		MDLabel :
			text : "Your Ticket"
			id: msg
			padding_y:10
			pos_hint:{"center_y":0.9,"center_x":0.5}
			spacing: 10
			font_style : "Button"
			font_size : 15
			halign : "center"
		MDLabel:
			text:""
			padding_y:10
			pos_hint:{"center_y":0.8}
			id: busno
			font_style : "Button"
			font_size : 15
			halign : "center"
		MDLabel:
			text:""
			padding_y:10
			pos_hint:{"center_y":0.7}
			id: busname
			font_style : "Button"
			font_size : 15
			halign : "center"
		MDLabel:
			text:""
			padding_y:10
			pos_hint:{"center_y":0.6}
			id: fromstation
			font_style : "Button"
			font_size : 15
			halign : "center"
		MDLabel:
			text:""
			padding_y:10
			pos_hint:{"center_y":0.5}
			id: destinationstation
			font_style : "Button"
			font_size : 15
			halign : "center"
		MDLabel:
			text:""
			padding_y:10
			pos_hint:{"center_y":0.4}
			id: seat
			font_style : "Button"
			font_size : 15
			halign : "center"
		MDLabel:
			text:""
			padding_y:10
			pos_hint:{"center_y":0.3}
			id: taka
			font_style : "Button"
			font_size : 15
			halign : "center"

		MDRoundFlatButton :
			text : 'Back'
			pos_hint : {"center_x":.2}
			font_size : 15
			padding_y:10
			#on_press: root.manager.current= 'showticket'
			on_press: root.do_back1()
		MDRoundFlatButton :
			text : 'Print'
			pos_hint : {"center_x":.1}
			font_size : 15
			padding_y:10
			on_press:root.print1()
			#on_press: root.manager.current= 'search'
<AdminTicketScreen>:
	name: 'adminticket'
	MDScreen :
		#md_bg_color : [2/255,69/255,208/255,1]
		Image:     # This part doesn't seem to work
            source: "bg.jpg"
            allow_stretch: True
            keep_ratio: False
            size_hint: 1, 1
			opacity: 0.5
		
		MDLabel :
			text : "Your Ticket"
			id: msg
			padding_y:10
			pos_hint:{"center_y":0.9,"center_x":0.5}
			spacing: 10
			font_style : "Button"
			font_size : 15
			halign : "center"
		MDLabel:
			text:""
			padding_y:10
			pos_hint:{"center_y":0.8}
			id: busno
			font_style : "Button"
			font_size : 15
			halign : "center"
		MDLabel:
			text:""
			padding_y:10
			pos_hint:{"center_y":0.7}
			id: busname
			font_style : "Button"
			font_size : 15
			halign : "center"
		MDLabel:
			text:""
			padding_y:10
			pos_hint:{"center_y":0.6}
			id: fromstation
			font_style : "Button"
			font_size : 15
			halign : "center"
		MDLabel:
			text:""
			padding_y:10
			pos_hint:{"center_y":0.5}
			id: destinationstation
			font_style : "Button"
			font_size : 15
			halign : "center"
		MDLabel:
			text:""
			padding_y:10
			pos_hint:{"center_y":0.4}
			id: seat
			font_style : "Button"
			font_size : 15
			halign : "center"
		MDLabel:
			text:""
			padding_y:10
			pos_hint:{"center_y":0.3}
			id: taka
			font_style : "Button"
			font_size : 15
			halign : "center"

		MDRoundFlatButton :
			text : 'Back'
			pos_hint : {"center_x":.2}
			font_size : 15
			padding_y:10
			on_press: root.do_back2()
		MDRoundFlatButton :
			text : 'Print'
			pos_hint : {"center_x":.1}
			font_size : 15
			padding_y:10
			on_press:root.print()
			#on_press: root.manager.current= 'search'
"""