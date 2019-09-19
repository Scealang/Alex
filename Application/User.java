package Application;

// Класс "пользователь"
public class User
{
    // Поля класса "пользователь"
    private String name; // Имя
    private String login; // Логин
    private String password; // Пароль
    boolean acess; // Доступность

    // Конструктор по умолчанию класса "пользователь"
    public User(){}

    // Конструктор с параметрами класса "пользователь"
    public User (String name, String login, String password)
    {
        acess = true;
        this.name = name;
        this.login = login;
        this.password = password;
    }

    // Метод входа в учетную запись пользователя
    public boolean enter(String login, String password)
    {
        if (login.equals(this.login)&&password.equals(this.password))
        {
            System.out.println("Вы успешно авторизировались\n");
            return true;
        }
        else
        {
            return false;
        }
    }

    // Метод получения имени
    public String getName()
    {
        return name;
    }

    // Метод получения доступности пользователя
    public boolean isAcess()
    {
        return acess;
    }

    //Метод смены доступности
    public boolean changeAcess()
    {
        acess=!acess;
        return acess;
    }
}
