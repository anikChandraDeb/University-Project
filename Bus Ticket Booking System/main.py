from kivy.app import App
from kivy.uix.gridlayout import GridLayout
from kivy.uix.label import Label
from kivy.uix.image import Image
from kivy.uix.button import Button
from kivy.uix.textinput import TextInput
from kivymd.app import MDApp
from kivy.lang import Builder
from kivy.properties import StringProperty
from kivy.uix.screenmanager import ScreenManager, Screen, SlideTransition
from kivymd.uix.screen import Screen
from kivymd.uix.datatables import MDDataTable
from kivy.metrics import dp
import os
import mysql.connector
from screen_helper import screen_helper
from fpdf import FPDF

#global variable user info
guserid=""
gmobile=""
gticket=()
gfromstation=""
gdestinationstation=""
gdate=""


class SearchTicketScreen(Screen):
	def do_search(self):
		fromstation=self.ids.fromstation.text
		destinationstation=self.ids.destinationstation.text
		datef=self.ids.date.text
		gfromstation=fromstation
		gdestinationstation=destinationstation
		gdate=datef
		print(str(gfromstation)+" "+str(gdestinationstation)+" "+str(gdate))
		mydb=mysql.connector.connect(
			host = "localhost",
			user = "root",
			password = "anik@deb",
			database = "btbs"
		)
		
		#create a cursor
		c=mydb.cursor()
		
		c.execute("SELECT * from bus")
		
		
		word=""
		for i in c:
			date=""
			temp=i[8]
			for j in range(10):
				date+=temp[j]
			if(fromstation.upper()==i[2] and destinationstation.upper()==i[3] and datef==date):
				col=i[0]+"   |   "+i[1]+"   |   "+i[2]+"   |   "+i[3]+"   |   "+str(i[5])+"   |   "+str(i[6])+"   |   "+i[8]
				#print(col)
				word=f'{word}\n{col}'
				self.manager.get_screen("showticket").ids.msg1.text=word
		if word=="":
			self.ids.msg.text="No Bus Found"
			return
		'''self.ids.fromstation.text=""
		self.ids.destinationstation.text=""
		self.ids.date.text=""'''
		self.manager.current='showticket'
		
		mydb.commit()
		mydb.close()
class AdminSearchTicketScreen(Screen):
	def do_search1(self):
		fromstation=self.ids.fromstation.text
		destinationstation=self.ids.destinationstation.text
		datef=self.ids.date.text
	
		mydb=mysql.connector.connect(
			host = "localhost",
			user = "root",
			password = "anik@deb",
			database = "btbs"
		)
		
		#create a cursor
		c=mydb.cursor()
		
		c.execute("SELECT * from bus")
		
		
		word=""
		for i in c:
			date=""
			temp=i[8]
			for j in range(10):
				date+=temp[j]
			if(fromstation.upper()==i[2] and destinationstation.upper()==i[3] and datef==date):
				col=i[0]+"   |   "+i[1]+"   |   "+i[2]+"   |   "+i[3]+"   |   "+str(i[5])+"   |   "+str(i[6])+"   |   "+i[8]
				#print(col)
				word=f'{word}\n{col}'
				self.manager.get_screen("adminshowticket").ids.msg1.text=word
		if word=="":
			self.ids.msg.text="No Bus Found"
			return
		'''self.ids.fromstation.text=""
		self.ids.destinationstation.text=""
		self.ids.date.text=""'''
		self.manager.current='adminshowticket'
		
		mydb.commit()
		mydb.close()		
			
class ShowTicketScreen(Screen):
	def do_purchase1(self):
		busno=self.ids.busno.text
		quantity=self.ids.quantity.text
		allstring=self.ids.msg1.text
		
		fromstation=self.manager.get_screen("search").ids.fromstation.text
		destinationstation=self.manager.get_screen("search").ids.destinationstation.text
		datef=self.manager.get_screen("search").ids.date.text
		#if(busno=="" or quantity>0):
		#	return
		self.ids.msg0.text=""
		if quantity=="":
			self.ids.msg0.text="Empty Quantity"
			return
		quantity=int(quantity)
		self.ids.msg0.text=""
		if(quantity>5):
			self.ids.msg0.text="Maximum 5 Ticket Purchase at a time"
			return
		mydb=mysql.connector.connect(
			host = "localhost",
			user = "root",
			password = "anik@deb",
			database = "btbs"
		)
		
		#create a cursor
		c=mydb.cursor()
		
		
		
		
		c.execute("SELECT * from bus where busno='"+busno+"'")
		
		for i in c:
		
			date=""
			temp=i[8]
			for j in range(10):
				date+=temp[j]
				
			if i[0]==busno and int(i[7])<=60 and (60-int(i[7]))>=quantity and fromstation.upper()==i[2] and destinationstation.upper()==i[3] and datef==date:
				b=busno
				totalcost=int(i[6])*quantity
				
				seat=int(i[7])
				lastseat=int(seat)+quantity-1
				self.manager.get_screen("ticket").ids.busno.text="Bus No : "+i[0]
				self.manager.get_screen("ticket").ids.busname.text="Bus Name : "+i[1]
				self.manager.get_screen("ticket").ids.fromstation.text="From : "+i[2]
				self.manager.get_screen("ticket").ids.destinationstation.text="Destination : "+i[3]
				if quantity>1:
					self.manager.get_screen("ticket").ids.seat.text="Seat : "+str(seat)+"-"+str(lastseat)
				else:
					self.manager.get_screen("ticket").ids.seat.text="Seat : "+str(seat)
				self.manager.get_screen("ticket").ids.taka.text="Taka : "+str(totalcost)
				aseat=int(i[5])-(quantity)
				cseat=int(i[7])+quantity
				
				c.execute("update bus set availableseat='"+str(aseat)+"',currentseat='"+str(cseat)+ "' where busno='"+busno+"'")
				mydb.commit()
				'''#query = "SELECT count(*) FROM users where email='"+str(input_email)+"' and password='"+str(input_password)+"'"
				#sql_command="UPDATE bus SET availableseat='"+str(aseat)+ "',currentseat='"+str(cseat)+ "' WHERE busno='"+busno+"'"
				#query = "update bus set availableseat='"+str(aseat)+"' where busno='"+busno+"'"
				#cursor.execute(query)
				#c.execute(query)
				
				busno=i[0]
				busname=i[1]
				fromstation=i[2]
				destinationstation=i[3]
				totalseat=i[4]
				totalseat=i[5]
				taka=i[6]
				cur=i[7]
				datetime=i[8]
				#delete row
				##sql_command="DELETE FROM bus WHERE busno=3880"
				#c.execute(sql_command)
				
				sql_command="INSERT INTO bus (busno,busname,fromstation,destinationstation,totalseat,availableseat,taka,currentseat,datetime) VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s)"
				values=(busno,busname,fromstation.upper(),destinationstation.upper(),totalseat,totalseat,taka,cur,datetime)
				c.execute(sql_command,values)'''
				
				self.manager.current='ticket'
		else:
			self.ids.msg0.text="Something Wrong try again"
			return
		mydb.commit()
		mydb.close()
		
		
class AdminShowTicketScreen(Screen):
	def do_purchase(self):
		busno=self.ids.busno.text
		quantity=int(self.ids.quantity.text)
		
		fromstation=self.manager.get_screen("searchadmin").ids.fromstation.text
		destinationstation=self.manager.get_screen("searchadmin").ids.destinationstation.text
		datef=self.manager.get_screen("searchadmin").ids.date.text
		if(quantity>5):
			self.ids.msg0.text="Maximum 5 Ticket Purchase at a time"
			return
		mydb=mysql.connector.connect(
			host = "localhost",
			user = "root",
			password = "anik@deb",
			database = "btbs"
		)
		
		#create a cursor
		c=mydb.cursor()
		
		c.execute("SELECT * from bus where busno='"+busno+"'")
		
		for i in c:
			
			date=""
			temp=i[8]
			for j in range(10):
				date+=temp[j]
			if i[0]==busno and int(i[7])<=60 and (60-int(i[7]))>=quantity and fromstation.upper()==i[2] and destinationstation.upper()==i[3] and datef==date:
				b=busno
				totalcost=int(i[6])*quantity
				
				seat=int(i[7])
				lastseat=int(seat)+quantity-1
				self.manager.get_screen("adminticket").ids.busno.text="Bus No : "+i[0]
				self.manager.get_screen("adminticket").ids.busname.text="Bus Name : "+i[1]
				self.manager.get_screen("adminticket").ids.fromstation.text="From : "+i[2]
				self.manager.get_screen("adminticket").ids.destinationstation.text="Destination : "+i[3]
				#self.manager.get_screen("adminticket").ids.seat.text="Seat : "+str(seat)+"-"+str(lastseat)
				if quantity>1:
					self.manager.get_screen("adminticket").ids.seat.text="Seat : "+str(seat)+"-"+str(lastseat)
				else:
					self.manager.get_screen("adminticket").ids.seat.text="Seat : "+str(seat)
				self.manager.get_screen("adminticket").ids.taka.text="Taka : "+str(totalcost)
				aseat=int(i[5])-(quantity)
				cseat=int(i[7])+quantity
				
				c.execute("update bus set availableseat='"+str(aseat)+"',currentseat='"+str(cseat)+ "' where busno='"+busno+"'")
				mydb.commit()
				'''sql_command="UPDATE bus SET availableseat=%s,currentseat=%s WHERE busno=%s"
				values=(str(aseat),str(cseat),b)
				c.execute(sql_command,values)'''
				
				
				self.manager.current='adminticket'
		else:
			self.ids.msg0.text="Something Wrong try again"
			return
		mydb.commit()
		mydb.close()
		
class MainScreen(Screen):
	def do_login(self,userText,passwordText,roleText):
	
		mydb=mysql.connector.connect(
			host = "localhost",
			user = "root",
			password = "anik@deb",
			database = "btbs"
		)
		
		#create a cursor
		c=mydb.cursor()
		
		#select all data from user
		c.execute("SELECT * from user")
		for i in c:
			if(userText==i[0] and passwordText==i[1] and roleText.lower()==i[3]):
				guserid=userText
				gmobile=i[2]
				self.ids.userid.text=""
				self.ids.password.text=""
				self.ids.role.text=""
				if(roleText.lower()=="admin"):
					self.manager.current = 'admin'
				else:
					self.manager.current = 'search'
				
		else:
			self.ids.msg.text="User isn't exists"
			return
		
class SignUpScreen(Screen):
	def do_signup(self):
		userid=self.ids.userid.text
		password=self.ids.password.text
		cpassword=self.ids.cpassword.text
		mobile=self.ids.mobile.text
		role="user"
		if(userid=="" or password=="" or role==""):
			self.ids.msg.text="Empty Field Not Accepted"
			return
		if(password!=cpassword):
			self.ids.msg.text="Password Not same"
			return
		if(len(mobile)!=11):
			self.ids.msg.text="Phone number Incorrect"
			return
			
			
		l, u, p, d = 0, 0, 0, 0
		valid=0
		s = password
		if (len(s) >= 8):
			for i in s:
		 
				# counting lowercase alphabets
				if (i.islower()):
					l+=1           
		 
				# counting uppercase alphabets
				if (i.isupper()):
					u+=1           
		 
				# counting digits
				if (i.isdigit()):
					d+=1           
		 
				# counting the mentioned special characters
				if(i=='@'or i=='$' or i=='_'):
					p+=1          
		if (l>=1 and u>=1 and p>=1 and d>=1 and l+p+u+d==len(s)):
			valid=1
		else:
			valid=0
		if valid==0:
			self.ids.msg.text="Weak password use[a-z,A-Z,0-9,@,$,_]"
			return
			
		#password: R@m@_f0rtu9e$
		mydb=mysql.connector.connect(
			host = "localhost",
			user = "root",
			password = "anik@deb",
			database = "btbs"
		)
		
		#create a cursor
		c=mydb.cursor()
		
		#user id unique or not
		c.execute("SELECT userid from user")
		for i in c:
			if(i[0]==userid):
				self.ids.msg.text="User Id is exists try another"
				return
				
		
		
		self.manager.current = 'main'
		self.ids.userid.text=""
		self.ids.password.text=""
		self.ids.cpassword.text=""
		self.ids.mobile.text=""
		sql_command="INSERT INTO user (userid,password,mobile,role) VALUES (%s,%s,%s,%s)"
		values=(userid,password,mobile,role)
		c.execute(sql_command,values)
		
		mydb.commit()

class AdminSignUpScreen(Screen):
	def do_signup(self):
		userid=self.ids.userid.text
		password=self.ids.password.text
		cpassword=self.ids.cpassword.text
		mobile=self.ids.mobile.text
		role="admin"
		if(userid=="" or password=="" or role==""):
			self.ids.msg.text="Empty Field Not Accepted"
			return
		if(password!=cpassword):
			self.ids.msg.text="Password Not same"
			return
		if(len(mobile)!=11):
			self.ids.msg.text="Phone number Incorrect"
			return
		
		
		l, u, p, d = 0, 0, 0, 0
		valid=0
		s = password
		if (len(s) >= 8):
			for i in s:
		 
				# counting lowercase alphabets
				if (i.islower()):
					l+=1           
		 
				# counting uppercase alphabets
				if (i.isupper()):
					u+=1           
		 
				# counting digits
				if (i.isdigit()):
					d+=1           
		 
				# counting the mentioned special characters
				if(i=='@'or i=='$' or i=='_'):
					p+=1          
		if (l>=1 and u>=1 and p>=1 and d>=1 and l+p+u+d==len(s)):
			valid=1
		else:
			valid=0
		if valid==0:
			self.ids.msg.text="Weak password use[a-z,A-Z,0-9,@,$,_]"
			return
			
		#password: R@m@_f0rtu9e$
		
		mydb=mysql.connector.connect(
			host = "localhost",
			user = "root",
			password = "anik@deb",
			database = "btbs"
		)
		
		#create a cursor
		c=mydb.cursor()
		
		#user id unique or not
		c.execute("SELECT userid from user")
		for i in c:
			if(i[0]==userid):
				self.ids.msg.text="User Id is exists try another"
				return
				
		
		self.ids.userid.text=""
		self.ids.password.text=""
		self.ids.cpassword.text=""
		self.ids.mobile.text=""
		self.ids.msg.text="Admin Added Successfully"
		
		sql_command="INSERT INTO user (userid,password,mobile,role) VALUES (%s,%s,%s,%s)"
		values=(userid,password,mobile,role)
		c.execute(sql_command,values)
		
		mydb.commit()
		
class AdminScreen(Screen):
	pass
class ManageBusScreen(Screen):
	def do_reset1(self):
		
		mydb=mysql.connector.connect(
			host = "localhost",
			user = "root",
			password = "anik@deb",
			database = "btbs"
		)
		
		#create a cursor
		c=mydb.cursor()
		
		c.execute("SELECT * from bus")
		
		
		word=""
		for i in c:
			col=i[0]+"   |   "+i[1]+"   |   "+i[2]+"   |   "+i[3]+"   |   "+str(i[5])+"   |   "+str(i[6])+"   |   "+i[8]
			#print(col)
			word=f'{word}\n{col}'
			self.manager.get_screen("adminresetbus").ids.msg1.text=word
		if word=="":
			self.ids.msg.text="No Bus Found"
			return
		'''self.ids.fromstation.text=""
		self.ids.destinationstation.text=""
		self.ids.date.text=""'''
		self.manager.current='adminresetbus'
		
		mydb.commit()
		mydb.close()
class AddBusScreen(Screen):
	def do_submit(self):
	
		mydb=mysql.connector.connect(
			host = "localhost",
			user = "root",
			password = "anik@deb",
			database = "btbs"
		)
		
		#create a cursor
		c=mydb.cursor()
		
		c.execute("""CREATE TABLE if not exists bus(
			busno varchar(20),
			busname varchar(30),
			fromstation varchar(30),
			destinationstation varchar(30),
			totalseat int,
			availableseat int,
			taka int,
			currentseat int,
			datetime varchar(40)
		)""")
		
		
		#insert data in bus table
		busno=self.ids.busno.text
		busname=self.ids.busname.text
		fromstation=self.ids.fromstation.text
		destinationstation=self.ids.destinationstation.text
		totalseat=int(self.ids.totalseat.text)
		taka=int(self.ids.taka.text)
		datetime=self.ids.datetime.text
		
		if(busno=="" or busname=="" or fromstation=="" or destinationstation=="" or totalseat=="" or taka=="" or datetime==""):
			self.ids.msg.text="Empty Field not Accepted"
			return
		#clear textfield
		self.ids.busno.text=""
		self.ids.busname.text=""
		self.ids.fromstation.text=""
		self.ids.destinationstation.text=""
		self.ids.totalseat.text=""
		self.ids.taka.text=""
		self.ids.datetime.text=""
		self.ids.msg.text="Bus Added Successfully"
		sql_command="INSERT INTO bus (busno,busname,fromstation,destinationstation,totalseat,availableseat,taka,currentseat,datetime) VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s)"
		values=(busno,busname,fromstation.upper(),destinationstation.upper(),totalseat,totalseat,taka,1,datetime)
		c.execute(sql_command,values)
		
		mydb.commit()
		mydb.close()
	

class TicketScreen(Screen):
	def do_back1(self):
		fromstation=self.manager.get_screen("search").ids.fromstation.text
		destinationstation=self.manager.get_screen("search").ids.destinationstation.text
		datef=self.manager.get_screen("search").ids.date.text
		self.manager.get_screen("showticket").ids.msg0.text=""
		#print(str(fromstation)+" "+str(destinationstation)+" "+str(datef))
		mydb=mysql.connector.connect(
			host = "localhost",
			user = "root",
			password = "anik@deb",
			database = "btbs"
		)
		
		#create a cursor
		c=mydb.cursor()
		
		c.execute("SELECT * from bus")
		
		
		word=""
		for i in c:
			date=""
			temp=i[8]
			for j in range(10):
				date+=temp[j]
			if(fromstation.upper()==i[2] and destinationstation.upper()==i[3] and datef==date):
				col=i[0]+"   |   "+i[1]+"   |   "+i[2]+"   |   "+i[3]+"   |   "+str(i[5])+"   |   "+str(i[6])+"   |   "+i[8]
				#print(col)
				word=f'{word}\n{col}'
				self.manager.get_screen("showticket").ids.msg1.text=word
		if word=="":
			self.ids.msg.text="No Bus Found"
			return
		
		self.manager.current='showticket'
		
		mydb.commit()
		mydb.close()
	
	
	def print1(self):
		pdf = FPDF()
		pdf.add_page()
		pdf.set_font("Arial", size = 15)
		busno=self.ids.busno.text
		busname=self.ids.busname.text
		fromstation=self.ids.fromstation.text
		destinationstation=self.ids.destinationstation.text
		seat=self.ids.seat.text
		taka=self.ids.taka.text
		# create a cell
		pdf.cell(200, 10, txt = "Your Ticket",
				ln = 1, align = 'C')

		# add another cell
		pdf.cell(200, 10, txt = str(busno),
				ln = 2, align = 'C')
		pdf.cell(200, 10, txt = str(busname),
				ln = 3, align = 'C')
		pdf.cell(200, 10, txt = str(fromstation),
				ln = 4, align = 'C')
		pdf.cell(200, 10, txt = str(destinationstation),
				ln = 5, align = 'C')
		pdf.cell(200, 10, txt = str(seat),
				ln = 6, align = 'C')
		pdf.cell(200, 10, txt = str(taka),
				ln = 7, align = 'C')
		pdf.cell(200, 10, txt = "Have a safe Journey...",
				ln = 8, align = 'C')
		# save the pdf with name .pdf
		pdf.output("ticket.pdf")
		
		
		
class AdminTicketScreen(Screen):
	def do_back2(self):
		fromstation=self.manager.get_screen("searchadmin").ids.fromstation.text
		destinationstation=self.manager.get_screen("searchadmin").ids.destinationstation.text
		datef=self.manager.get_screen("searchadmin").ids.date.text
		self.manager.get_screen("adminshowticket").ids.msg0.text=""
		#print(str(fromstation)+" "+str(destinationstation)+" "+str(datef))
		mydb=mysql.connector.connect(
			host = "localhost",
			user = "root",
			password = "anik@deb",
			database = "btbs"
		)
		
		#create a cursor
		c=mydb.cursor()
		
		c.execute("SELECT * from bus")
		
		
		word=""
		for i in c:
			date=""
			temp=i[8]
			for j in range(10):
				date+=temp[j]
			if(fromstation.upper()==i[2] and destinationstation.upper()==i[3] and datef==date):
				col=i[0]+"   |   "+i[1]+"   |   "+i[2]+"   |   "+i[3]+"   |   "+str(i[5])+"   |   "+str(i[6])+"   |   "+i[8]
				#print(col)
				word=f'{word}\n{col}'
				self.manager.get_screen("adminshowticket").ids.msg1.text=word
		if word=="":
			self.ids.msg.text="No Bus Found"
			return
		
		self.manager.current='adminshowticket'
		
		mydb.commit()
		mydb.close()
	
	def print(self):
		pdf = FPDF()
		pdf.add_page()
		pdf.set_font("Arial", size = 15)
		busno=self.ids.busno.text
		busname=self.ids.busname.text
		fromstation=self.ids.fromstation.text
		destinationstation=self.ids.destinationstation.text
		seat=self.ids.seat.text
		taka=self.ids.taka.text
		# create a cell
		pdf.cell(200, 10, txt = "Your Ticket",
				ln = 1, align = 'C')

		# add another cell
		pdf.cell(200, 10, txt = str(busno),
				ln = 2, align = 'C')
		pdf.cell(200, 10, txt = str(busname),
				ln = 3, align = 'C')
		pdf.cell(200, 10, txt = str(fromstation),
				ln = 4, align = 'C')
		pdf.cell(200, 10, txt = str(destinationstation),
				ln = 5, align = 'C')
		pdf.cell(200, 10, txt = str(seat),
				ln = 6, align = 'C')
		pdf.cell(200, 10, txt = str(taka),
				ln = 7, align = 'C')
		pdf.cell(200, 10, txt = "Have a safe Journey...",
				ln = 8, align = 'C')
		# save the pdf with name .pdf
		pdf.output("ticket.pdf")
class AdminResetBus(Screen):
	def do_reset(self):
		busno=self.ids.busno.text
		date=self.ids.date.text
		fromstation=self.ids.fromstation.text
		destinationstation=self.ids.destinationstation.text
		#print(busno+" "+date)
		
		mydb=mysql.connector.connect(
			host = "localhost",
			user = "root",
			password = "anik@deb",
			database = "btbs"
		)
		
		#create a cursor
		c=mydb.cursor()
		
		c.execute("SELECT * from bus where busno='"+busno+"'")
		totalseat=""
		for i in c:
			totalseat=i[4]
		
		c.execute("update bus set fromstation='"+str(fromstation.upper())+"',destinationstation='"+str(destinationstation.upper())+"',availableseat='"+str(totalseat)+"',currentseat='"+str(1)+ "',datetime='"+str(date)+"' where busno='"+busno+"'")
		mydb.commit()
		
		c.execute("SELECT * from bus")
		
		
		
		word=""
		for i in c:
			col=i[0]+"   |   "+i[1]+"   |   "+i[2]+"   |   "+i[3]+"   |   "+str(i[5])+"   |   "+str(i[6])+"   |   "+i[8]
			#print(col)
			word=f'{word}\n{col}'
			self.manager.get_screen("adminresetbus").ids.msg1.text=word
		if word=="":
			self.ids.msg.text="No Bus Found"
			return
		'''self.ids.fromstation.text=""
		self.ids.destinationstation.text=""
		self.ids.date.text=""'''
		self.manager.current='adminresetbus'
		
		mydb.commit()
		mydb.close()
	
	
sm = ScreenManager()
sm.add_widget(MainScreen(name='main'))
sm.add_widget(SearchTicketScreen(name='search'))
sm.add_widget(SignUpScreen(name='singup'))
sm.add_widget(AdminScreen(name='admin'))
sm.add_widget(AdminSearchTicketScreen(name='searchadmin'))
sm.add_widget(AdminSignUpScreen(name='signupadmin'))
sm.add_widget(ManageBusScreen(name='managebus'))
sm.add_widget(AddBusScreen(name='addbus'))
sm.add_widget(ShowTicketScreen(name='showticket'))
sm.add_widget(AdminShowTicketScreen(name='adminshowticket'))
sm.add_widget(TicketScreen(name='ticket'))
sm.add_widget(AdminTicketScreen(name='adminticket'))
sm.add_widget(AdminResetBus(name='adminresetbus'))

class MainApp(MDApp):
	def build(self):
		screen = Builder.load_string(screen_helper)
		#connect db
		mydb=mysql.connector.connect(
			host = "localhost",
			user = "root",
			password = "anik@deb",
			database = "btbs"
		)
		
		#create a cursor
		c=mydb.cursor()
		
		#create a db
		c.execute("CREATE DATABASE IF NOT EXISTS btbs")
		#c.execute("SHOW DATABASES")
		#for db in c:
		#	print(db)
		
		#create user table
		c.execute("""CREATE TABLE if not exists user(
			userid varchar(100),
			password varchar(100),
			mobile varchar(20),
			role varchar(20)
		)""")
		#c.execute("SELECT * FROM user")
		#print(c.description)
		
		#commit 
		mydb.commit()
		mydb.close()
		return screen

if __name__ == '__main__':
    MainApp().run()