package persister;

import domain.User;

public interface IUserPersister 
{
	User get(String userName);
	User get(long sessionId);
	void save(User user);
}
