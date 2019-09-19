package Application;

// Класс "администратор", наследник класса "пользователь"
public class Admin extends User
{
    // Конструктор класса "администратор"
    public Admin(String name, String login, String password)
    {
        super(name, login, password);
    }
}
