<?php


namespace App\Interfaces\OperationApi;

interface IExamSystemService
{
    public function GetExamList();

    public function GetExamPersonConnectList(
        $examId
    );

    public function GetQuestionsList(
        $examId
    );

    public function GetQuestionOptionsList(
        $questionId
    );

    public function GetExamResultReadingList(
        $examId
    );

    public function GetExamResultReadingReplyList(
        $id,
        $examId
    );

    public function GetExamResultList(
        $examId
    );

    public function SetExams(
        $name,
        $description,
        $time,
        $date
    );

    public function SetExamPersonConnect(
        $userId,
        $examId,
        $remainingTime,
        $status
    );

    public function SetQuestions(
        $examId,
        $question,
        $questionType,
        $order,
        $image
    );

    public function SetQuestionOptions(
        $questionId,
        $answer,
        $orderNumber
    );

    public function SetExamResultReadingReply(
        $list
    );
}
