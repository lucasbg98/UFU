<?php
abstract class Status
{
    //--- Usuário
	const User_Found     =  1;
    const User_Not_Found = -1;

    //--- Resultado
    const Resultado_Negativo = -1;
    const Resultado_Positivo =  1;
    const Resultado_Status_Pendente  =  0;
    const Resultado_Status_Aprovada  =  1;
    const Resultado_Status_Rejeitada = -1;

    //--- Substância
    const Substancia_Presente_Em_Misturas = 1;

    //--- Outros
    const Cadastro_Sucesso                =  1;
    const Cadastro_Erro_No_Banco_De_Dados = -1;
    const Wrong_Parameters                = -2;
    const Update_Sucesso                  =  3;
    const Update_Erro                     = -3;
}