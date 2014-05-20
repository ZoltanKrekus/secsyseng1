package persister;

import java.util.HashMap;
import java.util.Map;

import domain.User;

public class InMemoryUserPersister implements IUserPersister 
{
	private static final Map<String, User> DATABASE = new HashMap<String, User>();
	
	public InMemoryUserPersister()
	{
		//setup some test users
		save(new User("admin", "admin", 1));
		save(new User("root", "foo", 2));
		save(new User("max", "mustermann", 3));
	}
	
	@Override
	public User get(String userName) 
	{
		if(!DATABASE.containsKey(userName))
			return null;
		
		return DATABASE.get(userName);
	}

	@Override
	public void save(User user) 
	{
		DATABASE.put(user.getName(), user);		
	}

	@Override
	public User get(long sessionId) 
	{
		if(sessionId <= 0)
			return null;
		
		for (User user : DATABASE.values()) 
		{
			if(sessionId == user.getSessionId())
				return user;
		}
		return null;
	}

}
