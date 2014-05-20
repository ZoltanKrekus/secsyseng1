package domain;

import java.io.Serializable;

import javax.faces.bean.ManagedBean;
import javax.faces.bean.SessionScoped;

@ManagedBean
@SessionScoped
public class User implements Serializable
{

	private static final long serialVersionUID = -6755263400817352067L;

	private String name;
	private String password;
	private String sessionId;
	
	public User() 
	{
		super();
	}

	public User(String _name, String _password) 
	{
		super();
		this.name = _name;
		this.password = _password;
	}
		
	public User(String name, String password, String sessionId) 
	{
		super();
		this.name = name;
		this.password = password;
		this.sessionId = sessionId;
	}

	public String getName() 
	{
		return name;
	}
	
	public void setName(String name) 
	{
		this.name = name;
	}
	
	public String getPassword() 
	{
		return password;
	}
	
	public void setPassword(String password) 
	{
		this.password = password;
	}
	
	public String getSessionId() 
	{
		return sessionId;
	}
	
	public void setSessionId(String sessionId) 
	{
		this.sessionId = sessionId;
	}
}
