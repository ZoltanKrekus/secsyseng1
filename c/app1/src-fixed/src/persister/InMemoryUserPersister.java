package persister;

import java.util.HashMap;
import java.util.Map;
import java.util.UUID;

import domain.User;

public class InMemoryUserPersister implements IUserPersister 
{
	private static final Map<String, User> DATABASE = new HashMap<String, User>();
	
	public InMemoryUserPersister()
	{
		//setup some test users
		save(new User("admin", "admin", UUID.randomUUID().toString()));
		save(new User("root", "foo", UUID.randomUUID().toString()));
		save(new User("max", "mustermann", UUID.randomUUID().toString()));
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
	public User getBySessionId(String sessionId) 
	{
		if(sessionId == null || sessionId.isEmpty())
			return null;
		
		for (User user : DATABASE.values()) 
		{
			if(sessionId.equals(user.getSessionId()))
				return user;
		}
		return null;
	}

}
