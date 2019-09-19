package Application;

// Класс "профессор", наследник класса "пользователь"
public class Professor extends User
{
    // Конструктор класса "профессор"
    public Professor(String name, String login, String password)
    {
        super(name, login, password);
    }
}
