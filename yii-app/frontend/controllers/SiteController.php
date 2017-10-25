<?php
namespace frontend\controllers;

use common\models\Ticket;
use Yii;
use yii\base\InvalidParamException;
use yii\helpers\VarDumper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\TicketForm;
use common\models\TeamForm;
use common\models\ChooseTeamForm;
use common\models\InviteForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\myHelper;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'viewMyTickets'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * This is where I add code
     */

    public function actionNoPermission()
    {
        return $this->render('noPermission', ['model' => Yii::$app->user->identity]);
    }

    public function actionChooseTeam()
    {
        if (Yii::$app->user->isGuest) {
            return $this->actionLogin();
        }
        else {
            if(Yii::$app->request->isPost) {
                $postData = Yii::$app->request->post('ChooseTeamForm');
                $team_id = $postData['team_id'];

                $team_admins_ids = \common\models\Team::findOne(['id' => $team_id])->admins_ids;
                $team_project_managers_ids = \common\models\Team::findOne(['id' => $team_id])->project_manager_id;

                //to assign a ticket, you must either be an admin or a project manager in that team
                if (myHelper::findIdInString($team_admins_ids, Yii::$app->user->id) ||
                    myHelper::findIdInString($team_project_managers_ids, Yii::$app->user->id)) {
                    $model = new TicketForm();
                    if ($model->load(Yii::$app->request->post())) {
                        return $this->goBack();
                    }
                    return $this->redirect(['assign-tickets', 'chosen_team_id' => $team_id]);
                }
                else {
                    //does not have privilege to assign a ticket
                    return $this->redirect(['no-permission']);
                }
            }
            else {
                    $chooseTeamForm = new ChooseTeamForm();
                    return $this->render('chooseTeam', ['model' => Yii::$app->user->identity, 'chooseTeamModel' => $chooseTeamForm]);
            }
        }
    }

    public function actionViewMyTickets()
    {
        if (Yii::$app->user->isGuest) {
            return $this->actionLogin();
        }
        else {
            return $this->render('viewMyTickets', ['model' => Yii::$app->user->identity]);
        }
    }

    public function actionViewTeamTickets()
    {
        if (Yii::$app->user->isGuest) {
            return $this->actionLogin();
        }
        else {
            return $this->render('viewTeamTickets', ['model' => Yii::$app->user->identity]);
        }
    }

    public function actionAssignTickets($chosen_team_id) /* ALSO CHECK if it's Admin / Project Manager */
    {
        if (Yii::$app->user->isGuest) { //must be logged in
            return $this->actionLogin();
        }
        else {
            if (Yii::$app->request->isPost) {
                $model = new TicketForm();
                $postData = Yii::$app->request->post('TicketForm');
                $model->description = $postData['description'];

                if(!$postData)
                {
                    VarDumper::dump($postData, 10, true);
                    Yii::$app->end();
                }
                $model->status = $postData['status'];
                $model->users = $postData['users'];
                $model->deadline = $postData['deadline'];
                $model->team_id = $chosen_team_id;

                $ticket = $model->assign();

                if ($ticket !== false) {
                    Yii::$app->session->setFlash('success', "Ticket assigned.");
                    //need to also update tickets_ids in the team and Tickets in all the users
                    //update tickets_ids in the team
                    \common\models\Team::findOne(['id' => $chosen_team_id])->addTicketId($ticket->id);

                    //UPDATE Tickets in all the users
                    //no need to check if users is not NULL, since picking at least 1 user upon ticket assignment is mandatory
                    foreach($model->users as $userId)
                    {
                        \common\models\User::findOne(['id' => $userId])->addTicketId($ticket->id);
                    }
                    return $this->refresh();
                }
            }
            else {
                $model = new TicketForm();
                if ($model->load(Yii::$app->request->post())) {
                    return $this->goBack();
                }
                return $this->render('assignTickets', ['ticketModel' => $model, 'chosen_team_id' => $chosen_team_id]);
            }
        }
    }

    public function actionCreateTeam()
    {
        if (Yii::$app->user->isGuest) { //must be logged in
            return $this->actionLogin();
        }
        /*else if(Yii::$app->user->identity->getRole() != "Project Manager" && Yii::$app->user->identity->getRole() != "Admin") {//must be a project manager
            return $this->render('noPermission', ['model' => Yii::$app->user->identity]);
        }*/
        else
        {
            if(Yii::$app->request->isPost)
            {
                $model = new TeamForm();
                $postData = Yii::$app->request->post('TeamForm');
                $model->name = $postData['name'];
                $model->description = $postData['description'];
                $model->users = $postData['users'];
                $team = $model->create();

                //add this team to the teams_ids of the team_users
                Yii::$app->user->identity->addTeamId($team->id);

                if($model->users)
                {
                    foreach ($model->users as $user_id)
                    {
                        \common\models\User::findOne(['id' => $user_id])->addTeamId($team->id); //add this team to teams_ids of all of its members
                    }
                }

                if ($team !== false) {
                    Yii::$app->session->setFlash('success', "Team created.");
                    return $this->refresh();
                }
            }
            else
            {
                $model = new TeamForm();
                if ($model->load(Yii::$app->request->post())) {
                    return $this->goBack();
                }
                return $this->render('createTeam', ['teamModel' => $model]);
            }
        }
    }

    public function actionViewMyTeams()
    {
        if (Yii::$app->user->isGuest) {
            return $this->actionLogin();
        }
        return $this->render('viewMyTeams', ['model' => Yii::$app->user->identity]);
    }

    public function actionViewMyTeamInvitations()
    {
        if (Yii::$app->user->isGuest) {
            return $this->actionLogin();
        }
        return $this->render('viewMyTeamInvitations', ['model' => Yii::$app->user->identity]);
    }

    public function actionInviteMembers()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->actionLogin();
        }
        else
        {
            if(Yii::$app->request->isPost)
            {
                $postData = Yii::$app->request->post('InviteForm');
                $model = new InviteForm();

                $model->team_id = $postData['team_id'];
                $model->user_id = $postData['user_id'];
                $model->role    = $postData['role'];

                $invite = $model->invite();
            }
            else
            {
                $modelInvite = new InviteForm();
                if ($modelInvite->load(Yii::$app->request->post())) {
                    return $this->goBack();
                }
                return $this->render('inviteMembers', ['model' => Yii::$app->user->identity, 'inviteModel' => $modelInvite]);
            }
        }
    }
}
