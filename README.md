# Nordic Guide Server - Laravel

## Requirements

### Admin view requirements

Registered users can login to the adminsite by entering /admin/-folder through
webbrowser. Users can register themselves as Guides from login page. Here are the
features required for admin site

* Every user can access the “My profile” page where they can

	- Update their password
	- Update profile image
	- Update language skills
	- Update their connection to guide clubs
	- Update their profile information
	- Change their email address (remember to check, that email does not
exist in database)
* Users with admin role can access the menu items “Members”, “Languages”
and “Fees”

	- In languages admin can add and remove languages available

	- In members, admin sees the list of members – admins own name not
in the list
		* Admin can update the role of members in the list
		* Admin can update password for members in the list
		* Admin can update email for members in the list

		
	- In fees, admin sees the list of years with fees and
	
		* Can update the fees in selected year
		* Can see the list of member fees paid by members by clicking
“Show payments” in each year
