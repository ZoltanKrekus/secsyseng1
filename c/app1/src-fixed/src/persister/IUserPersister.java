package persister;

import domain.User;

public interface IUserPersister 
{
	User get(String userName);
	User getBySessionId(String sessionId);
	void save(User user);
}
