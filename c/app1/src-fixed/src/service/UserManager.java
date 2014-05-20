package service;

import java.io.Serializable;
import java.util.UUID;

import javax.faces.bean.ManagedBean;
import javax.faces.bean.ManagedProperty;
import javax.faces.bean.SessionScoped;

import persister.IUserPersister;
import persister.InMemoryUserPersister;
import domain.User;

@ManagedBean
@SessionScoped
public class UserManager implements Serializable
{
	private static final long serialVersionUID = 3664487104094127014L;

	private final static IUserPersister PERSISTER = new InMemoryUserPersister();
		
	@ManagedProperty(value="#{user}")
	private User user;
		
	public User getUser() {
		return user;
	}

	public void setUser(User user) {
		this.user = user;
	}
	

	public UserManager() 
	{
		
	}
	
	public String login()
	{
		User user = PERSISTER.get(this.user.getName());
		if(user == null)
			return "fail";
		
		boolean match = user.getPassword().equals(this.user.getPassword());
			
		if(match)
		{
			String sessionId = UUID.randomUUID().toString();
			this.user.setSessionId(sessionId);
			user.setSessionId(sessionId);
			
			PERSISTER.save(user);
									
			return "success";
		}
		return "fail";
	}
	
	
		
	public String loginBySessionId()
	{
		User user = PERSISTER.getBySessionId(this.user.getSessionId());
		if(user == null)
			return "fail";
		
		this.user.setName(user.getName());
		
		return "success";
	}
}
