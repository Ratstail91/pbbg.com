PBBG.com
==========
Pbbg.com website for Persistent Browser-Based Games. This open source project
consists of the API and the Front-End applications.

## Prerequisites to Develop
* docker
* docker-compose
* node

## Developing
1) [Fork](https://docs.github.com/en/free-pro-team@latest/github/getting-started-with-github/fork-a-repo) this repository
2) `git clone https://github.com/bpkennedy/pbbg.com && cd pbbg.com` - clone your fork (**I'm using my username in the path as example**) and enter the directory.
3) `git checkout -b nameMeBetterFeatureBranch` - create a new branch for the work you are doing named whatever makes sense,
4) copy `.env.example` into a new file named `.env`,
5) `npm run install-php-deps` - install php dependencies,
6) `npm install` - install node dependencies,
7) `npm start` - run Laravel, UI served on http://localhost.

> You may get an error about being unable to execute a script without permissions for the bash scripts. If on Mac/Linux, 
> grant permissions by doing `chmod 755 ./scripts/php-deps.sh`. If on windows, try using the Access Control List to 
> change the file permissions.

## Contributing
Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct
1. We *highly* encourage [short, concise git commit messages](https://chris.beams.io/posts/git-commit/).
2. Ensure any lint and tests pass locally before creating your Pull Request.
3. Your Pull Request must be approved by at least one contributor.

> Longer Contributing document on how to offer feedback, our standards, responsibilities, code of conduct, and
>enforcement can be found in [contributing guidelines](/CONTRIBUTING.md)

## Built With
### API
Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:
- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

### FE
Vue.js
- See [Configuration Reference](https://cli.vuejs.org/config/).

## License
Content is released under [GNU GPL v3.0](https://www.gnu.org/licenses/gpl-3.0.en.html).
