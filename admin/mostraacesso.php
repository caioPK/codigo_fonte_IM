<div class="tabs">
            <ul class="tab-links">
              <li class="active"><a href="#tab1">D.R.E</a></li>
              <li><a href="#tab2">Estoque</a></li>
              <li><a href="#tab3">Caixa</a></li>
              <li><a href="#tab4">Balanço</a></li>
              <li><a href="#tab5">Decisões</a></li>
              <li><a href="#tab6">Ranking</a></li>
              <li><a href="#tab7">Índices</a></li>
            </ul>
            
            <!-- Demonstração do resultado do exercício!! -->
            <div class="tab-content">
              <?php
                include("func_resultados.php"); 
                echo '
                <div id="tab1" class="tab active">
                  <div align=center>
                    <h3>Demonstração do resultado do exercício</h3>
                    <table class="tabusuario">     
                      <tr>
                        <th>Nome do lançamento</th>
                        <th>Valor</th>
                      </tr>
                      <tr> 
                        <td><p>Receita (P1*Q1+P2*Q2+P3*Q3+P4*Q4)</p></td>
                        <td><p>'.$Receita.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>Custo do Material Vendido (CMV)</p></td>
                        <td><p>'.$CMV.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>= '.$ResultadoBruto.'</p></td>
                        <td><p>'.$LucroLiquido.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- Depreciação</p></td>
                        <td><p>'.$LucroBruto.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- Salários Administrativos</p></td>
                        <td><p>'.$SalAdm.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- FGTS (8% salário bruto)</p></td>
                        <td><p>'.$FGTS.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- INSS (29% salário bruto)</p></td>
                        <td><p>'.$INSS.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- ICMS (4% do faturamento)</p></td>
                        <td><p>'.$ICMS.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- PIS (3,5% faturamento)</p></td>
                        <td><p>'.$PIS.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- COFINS (4% faturamento)</p></td>
                        <td><p>'.$COFINS.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- Ociosidade </p></td>
                        <td><p>'.$Ociosidade.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- Pesquisa e Desenvolvimento</p></td>
                        <td><p>'.$PeD.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- Publicidade</p></td>
                        <td><p>'.$Publicidade.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- Despesas Gerais (1,5% faturamento) </p></td>
                        <td><p>'.$DespesasGerais.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- Custos de Estocagem ($30 por unidade restante)</p></td>
                        <td><p>'.$CustoEstocagem.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- Qualidade</p></td>
                        <td><p>'.$Qualidade.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- Marketing</p></td>
                        <td><p>'.$Marketing.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- Energia Administrativo</p></td>
                        <td><p>'.$EnergiaAdm.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>= '.$ResultadoOperacional.'</p></td>
                        <td><p>'.$LucroOperacional.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>+ Receitas não-operacionais</p></td>
                        <td><p>'.$RecNaoOperacional.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- Despesas não operacionais</p></td>
                        <td><p>'.$DesNaoOperacional.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>'.$ResultadoSemIR.'</p></td>
                        <td><p>'.$LucroSemIR.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- IRPJ</p></td>
                        <td><p>'.$IRPJ.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>= '.$ResultadoLiquido.'</p></td>
                        <td><p>'.$LucroLiquido.'</p></td>
                      </tr>
                    </table>
                  </div>
                  <div style="margin-top: 1rem;">
                    <a href="">
                      <img class="logo" src="/imgs/pdf.png" style="width: 2rem; height: 1.8rem; padding-right: 0.5rem;">Clique aqui para imprimir este relatório em PDF</br>
                    </a>
                    <a href="">
                      <img class="logo" src="/imgs/pdf.png" style="width: 2rem; height: 1.8rem; padding-right: 0.5rem; padding-top: 0.5rem;">Clique aqui para imprimir todos os relatórios em PDF
                    </a>
                  </div>
                </div>
                ';
                ?>
                <!-- Demonstração do resultado do exercício!! -->


                <!-- ESTOQUE!! -->
                <div id="tab2" class="tab">
                  <div align=center>
                    <h3>Estoque</h3>
                    <?php
                      include("func_estoque.php");
                      echo '

                    <table class="tabusuario">     
                      <tr>
                          <th><p>Produto</p></th>
                          <th><p>EstInic</p></th>
                          <th><p>Produção</p></th>
                          <th><p>Vendas</p></th>
                          <th><p>BackOrder</p></th>
                          <th><p>EstFinal</p></th>
                          <th><p>ValorEstoq</p></th>
                          <th><p>ValUnit</p></th>
                      </tr>
                      <tr> 
                        <td><p>1</p></td>
                        <td><p>'.$Estoqueant[1].'</p></td>
                        <td><p>'.$Producao[1].'</p></td>
                        <td><p>'.$Vendas[1].'</p></td>
                        <td><p>'.$Perdas[1].'</p></td>
                        <td><p>'.$Estoque[1].'</p></td>
                        <td><p>'.$ValEstoque[1].'</p></td>
                        <td><p>'.$ValUnit[1].'</p></td>
                      </tr>
                      <tr> 
                        <td><p>2</p></td>
                        <td><p>'.$Estoqueant[2].'</p></td>
                        <td><p>'.$Producao[2].'</p></td>
                        <td><p>'.$Vendas[2].'</p></td>
                        <td><p>'.$Perdas[2].'</p></td>
                        <td><p>'.$Estoque[2].'</p></td>
                        <td><p>'.$ValEstoque[2].'</p></td>
                        <td><p>'.$ValUnit[2].'</p></td>
                      </tr>
                      <tr> 
                        <td><p>3</p></td>
                        <td><p>'.$Estoqueant[3].'</p></td>
                        <td><p>'.$Producao[3].'</p></td>
                        <td><p>'.$Vendas[3].'</p></td>
                        <td><p>'.$Perdas[3].'</p></td>
                        <td><p>'.$Estoque[3].'</p></td>
                        <td><p>'.$ValEstoque[3].'</p></td>
                        <td><p>'.$ValUnit[3].'</p></td>
                      </tr>
                      <tr> 
                        <td><p>4</p></td>
                        <td><p>'.$Estoqueant[4].'</p></td>
                        <td><p>'.$Producao[4].'</p></td>
                        <td><p>'.$Vendas[4].'</p></td>
                        <td><p>'.$Perdas[4].'</p></td>
                        <td><p>'.$Estoque[4].'</p></td>
                        <td><p>'.$ValEstoque[4].'</p></td>
                        <td><p>'.$ValUnit[4].'</p></td>
                      </tr>
                    </table>
                    <table class="tabusuario" style="margin-top:1rem;">     
                      <tr>
                        <th><p>Impostos a Pagar</p></th>
                        <th><p>Valor</p></th>
                      </tr>
                      <tr>
                        <td><p>FGTS</p></td>
                        <td><p>'.$FGTS.'</p></td>
                      </tr>
                      <tr>
                        <td><p>INSS</p></td>
                        <td><p>'.$INSS.'</p></td>
                      </tr>
                      <tr>
                        <td><p>ICMS</p></td>
                        <td><p>'.$ICMS.'</p></td>
                      </tr>
                      <tr>
                        <td><p>PIS</p></td>
                        <td><p>'.$PIS.'</p></td>
                      </tr>
                      <tr>
                        <td><p>COFINS</p></td>
                        <td><p>'.$COFINS.'</p></td>
                      </tr>
                      <tr>
                        <td><p>Juros à Pagar</p></td>
                        <td><p>'.$DesNaoOperacional.'</p></td>
                      </tr>
                      <tr>
                        <td><p>IRPJ à Pagar</p></td>
                        <td><p>'.$IRPJ.'</p></td>
                      </tr>
                      <tr>
                        <th><p>Total de Impostos a Pagar = </p></th>
                        <td><p>'.$TotalContasPagar.'</p></td>
                      </tr>
                      <tr>
                        <td><p>Contas à Pagar</p></td>
                        <td><p>'.$Energia.'</p></td>
                      </tr>
                    </table>
                  </div>
                  <div style="margin-top: 1rem;">
                    <a href="">
                      <img class="logo" src="/imgs/pdf.png" style="width: 2rem; height: 1.8rem; padding-right: 0.5rem;">Clique aqui para imprimir este relatório em PDF</br>
                    </a>
                    <a href="">
                      <img class="logo" src="/imgs/pdf.png" style="width: 2rem; height: 1.8rem; padding-right: 0.5rem; padding-top: 0.5rem;">Clique aqui para imprimir todos os relatórios em PDF
                    </a>
                  </div>
                </div>
                ';
              ?>



              <?php

                include("func_caixa.php");
                
                echo '

                


                <div id="tab3" class="tab">
                  <div align=center>
                    <h3>Caixa</h3>
                    <table class="tabusuario">     
                      <tr>
                          <th><p>Nome do lançamento</p></th>
                          <th><p>Débito</p></th>
                          <th><p>Crédito</p></th>
                          <th><p>Saldo</p></th>
                      </tr>
                      <tr> 
                        <td><p>Caixa inicial da jogada</p></td>
                        <td><p>'.$Caixa.'</p></td>
                        <td><p></p></td>
                        <td><p>'.$saldo[4].'</p></td>
                      </tr>
                      <tr> 
                        <td><p>+ Receita</p></td>
                        <td><p>'.$Receita.'</p></td>
                        <td><p></p></td>
                        <td><p>'.$saldo[5].'</p></td>
                      </tr>
                      <tr> 
                        <td><p>+ Empréstimo solicitado</p></td>
                        <td><p>'.$Emprestimo.'</p></td>
                        <td><p></p></td>
                        <td><p>'.$saldo[6].'</p></td>
                      </tr>
                      <tr> 
                        <td><p>+ Crédito Emergencial</p></td>
                        <td><p>'.$CreditoEmergencial.'</p></td>
                        <td><p></p></td>
                        <td><p>'.$saldo[7].'</p></td>
                      </tr>
                      <tr> 
                        <td><p>+ Juros Recebidos</p></td>
                        <td><p>'.$RecNaoOperacional.'</p></td>
                        <td><p></p></td>
                        <td><p>'.$saldo[8].'</p></td>
                      </tr>
                      <tr> 
                        <td><p>+ Aplicação Anterior</p></td>
                        <td><p>'.$AplicacaoAnterior.'</p></td>
                        <td><p></p></td>
                        <td><p>'.$saldo[9].'</p></td>
                      </tr>
                      <tr> 
                        <td><p>+ Recebimento de duplicatas</p></td>
                        <td><p>'.$RecebimentoDuplicata.'</p></td>
                        <td><p></p></td>
                        <td><p>'.$saldo[10].'</p></td>
                      </tr>
                      <tr> 
                        <td><p>-Pagamento de Fornecedores</p></td>
                        <td><p></p></td>
                        <td><p>'.$PagamentoFornecedor.'</p></td>
                        <td><p>'.$saldo[11].'</p></td>
                      </tr>
                      <tr> 
                        <td><p>-Aplicação Atual</p></td>
                        <td><p></p></td>
                        <td><p>'.$AplicacaoAtual.'</p></td>
                        <td><p>'.$saldo[12].'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- Amortização</p></td>
                        <td><p></p></td>
                        <td><p>'.$Amortizacao.'</p></td>
                        <td><p>'.$saldo[13].'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- Construções</p></td>
                        <td><p></p></td>
                        <td><p>'.$CaixaConstrucoes.'</p></td>
                        <td><p>'.$saldo[14].'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- Equipamentos</p></td>
                        <td><p></p></td>
                        <td><p>'.$CaixaEquipamentos.'</p></td>
                        <td><p>'.$saldo[15].'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- Material</p></td>
                        <td><p></p></td>
                        <td><p>'.$CaixaMaterial.'</p></td>
                        <td><p>'.$saldo[16].'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- Energia</p></td>
                        <td><p></p></td>
                        <td><p>'.$CaixaEnergia.'</p></td>
                        <td><p>'.$saldo[17].'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- Salários</p></td>
                        <td><p></p></td>
                        <td><p>'.$CaixaSalario.'</p></td>
                        <td><p>'.$saldo[18].'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- INSS</p></td>
                        <td><p></p></td>
                        <td><p>'.$CaixaINSS.'</p></td>
                        <td><p>'.$saldo[19].'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- FGTS </p></td>
                        <td><p></p></td>
                        <td><p>'.$CaixaFGTS.'</p></td>
                        <td><p>'.$saldo[20].'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- ICMS </p></td>
                        <td><p></p></td>
                        <td><p>'.$ICMSAT.'</p></td>
                        <td><p>'.$saldo[21].'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- PIS</p></td>
                        <td><p></p></td>
                        <td><p>'.$PISAT.'</p></td>
                        <td><p>'.$saldo[22].'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- COFINS </p></td>
                        <td><p></p></td>
                        <td><p>'.$COFINSAT.'</p></td>
                        <td><p>'.$saldo[23].'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- P&D</p></td>
                        <td><p></p></td>
                        <td><p>'.$PeD.'</p></td>
                        <td><p>'.$saldo[24].'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- Publicidade</p></td>
                        <td><p></p></td>
                        <td><p>'.$Publicidade.'</p></td>
                        <td><p>'.$saldo[25].'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- Despesas Gerais</p></td>
                        <td><p></p></td>
                        <td><p>'.$DespesasGerais.'</p></td>
                        <td><p>'.$saldo[26].'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- Custos de Estocagem </p></td>
                        <td><p></p></td>
                        <td><p>'.$CustoEstocagem.'</p></td>
                        <td><p>'.$saldo[27].'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- Qualidade</p></td>
                        <td><p></p></td>
                        <td><p>'.$Qualidade.'</p></td>
                        <td><p>'.$saldo[28].'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- Marketing</p></td>
                        <td><p></p></td>
                        <td><p>'.$Marketing.'</p></td>
                        <td><p>'.$saldo[29].'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- Juros a Pagar</p></td>
                        <td><p></p></td>
                        <td><p>'.$DesNaoOperacionalAT.'</p></td>
                        <td><p>'.$saldo[30].'</p></td>
                      </tr>
                      <tr> 
                        <td><p>- IRPJ</p></td>
                        <td><p></p></td>
                        <td><p>'.$IRPJAT.'</p></td>
                        <td><p>'.$saldo[31].'</p></td>
                      </tr>
                    </table>
                  </div>
                  <div style="margin-top: 1rem;">
                    <a href="">
                      <img class="logo" src="/imgs/pdf.png" style="width: 2rem; height: 1.8rem; padding-right: 0.5rem;">Clique aqui para imprimir este relatório em PDF</br>
                    </a>
                    <a href="">
                      <img class="logo" src="/imgs/pdf.png" style="width: 2rem; height: 1.8rem; padding-right: 0.5rem; padding-top: 0.5rem;">Clique aqui para imprimir todos os relatórios em PDF
                    </a>
                  </div>
                </div>
                ';
              ?>


              <?php

              include("func_balanco.php");
              echo '

                <div id="tab4" class="tab">
                  <div align=center>
                    <h3>Balanço</h3>
                    <table class="tabusuario">     
                      <tr>
                          <th style="width: 50%;">Ativo</th>
                          <th style="width: 50%;">Passivo</th>
                      </tr>
                      <tr>
                        <table class="tabusuario">
                          <tr>
                            <td style="width: 30%;"><p>Disponível</p></td>
                            <td style="width: 20%;"><p></p></td>
                            <td style="width: 30%;"><p>Exigível</p></td>
                            <td style="width: 20%;"><p></p></td>
                          </tr>
                        </table>   
                      </tr>
                      <tr>
                        <table class="tabusuario">
                          <tr>
                            <td style="width: 30%;"><p>Caixa</p></td>
                            <td style="width: 20%;"><p>'.$Caixa.'</p></td>
                            <td style="width: 30%;"><p>Empréstimos</p></td>
                            <td style="width: 20%;"><p>'.$Emprestimo.'</p></td>
                          </tr>   
                        </table> 
                      </tr>
                      <tr>
                        <table class="tabusuario">
                          <tr>
                            <td style="width: 30%;"><p>Aplicações</p></td>
                            <td style="width: 20%;"><p>'.$Aplicacao.'</p></td>
                            <td style="width: 30%;"><p>Crédito Emergencial</p></td>
                            <td style="width: 20%;"><p>'.$CreditoEmergencial.'</p></td>
                          </tr>   
                      </tr>
                      <tr>
                        <table class="tabusuario">
                          <tr>
                            <td style="width: 30%;"><p></p></td>
                            <td style="width: 20%;"><p></p></td>
                            <td style="width: 30%;"><p>Salários à pagar</p></td>
                            <td style="width: 20%;"><p>'.$salariosapagar.'</p></td>
                          </tr> 
                        </table>   
                      </tr>
                      <tr>
                        <table class="tabusuario">
                          <tr>
                            <td style="width: 30%;"><p>Realizável</p></td>
                            <td style="width: 20%;"><p></p></td>
                            <td style="width: 30%;"><p>Impostos à Pagar</p></td>
                            <td><p>'.$impostosapagar.'</p></td>
                          </tr>
                        </table>    
                      </tr>
                      <tr>
                        <table class="tabusuario">
                          <tr>
                            <td style="width: 30%;"><p>Estoque</p></td>
                            <td style="width: 20%;"><p>'.$Estoque.'</p></td>
                            <td style="width: 30%;"><p>Contas à Pagar</p></td>
                            <td style="width: 20%;"><p>'.$contasapagar.'</p></td>
                          </tr>   
                      </tr>
                      <tr>
                        <table class="tabusuario">
                          <tr>
                            <td style="width: 30%;"><p>Duplicatas à receber</p></td>
                            <td style="width: 20%;"><p>'.$DuplicatasReceber.'</p></td>
                            <td style="width: 30%;"><p>Fornecedores</p></td>
                            <td style="width: 20%;"><p>'.$Fornecedores.'</p></td>
                          </tr>
                        </table>    
                      </tr>
                      <tr>
                        <table class="tabusuario">
                          <tr>
                            <td style="width: 30%;"><p></p></td>
                            <td style="width: 20%;"><p></p></td>
                            <td style="width: 30%;"><p>Juros à Pagar</p></td>
                            <td style="width: 20%;"><p>'.$DesNaoOperacional.'</p></td>
                          </tr>
                        </table>    
                      </tr>
                      <tr>
                        <table class="tabusuario" style="border: none;">
                          <tr>
                            <td style="width: 30%; height: 2rem;"><p></p></td>
                            <td style="width: 20%; height: 2rem;"><p></p></td>
                            <td style="width: 30%; height: 2rem;"><p></p></td>
                            <td style="width: 20%; height: 2rem;"><p></p></td>
                          </tr>
                        </table>    
                      </tr>
                      <tr>
                        <table class="tabusuario">
                          <tr>
                            <td style="width: 30%;"><p>Total Realizável</p></td>
                            <td style="width: 20%;"><p>'.$TotalReal.'</p></td>
                            <td style="width: 30%;"><p>Total Exigível</p></td>
                            <td style="width: 20%;"><p>'.$TotalEx.'</p></td>
                          </tr>
                        </table>    
                      </tr>
                      <tr>
                        <table class="tabusuario">
                          <tr>
                            <td style="width: 30%;"><p>Imobilizado</p></td>
                            <td style="width: 20%;"><p></p></td>
                            <td style="width: 30%;"><p>Não Exigível</p></td>
                            <td style="width: 20%;"><p></p></td>
                          </tr>
                        </table>    
                      </tr>
                      <tr>
                        <table class="tabusuario">
                          <tr>
                            <td style="width: 30%;"><p>Construções</p></td>
                            <td style="width: 20%;"><p>'.$Construcoes.'</p></td>
                            <td style="width: 30%;"><p>Capital</p></td>
                            <td style="width: 20%;"><p>'.$Capital.'</p></td>
                          </tr>
                        </table>    
                      </tr>
                      <tr>
                        <table class="tabusuario">
                          <tr>
                            <td style="width: 30%;"><p>Equipamentos</p></td>
                            <td style="width: 20%;"><p>'.$Equipamentos.'</p></td>
                            <td style="width: 30%;"><p>'.$ResultadoAcumulados.'</p></td>
                            <td style="width: 20%;"><p>'.$LucroAcumulado.'</p></td>
                          </tr>
                        </table>    
                      </tr>
                      <tr>
                        <table class="tabusuario">
                          <tr>
                            <td style="width: 30%;"><p></p></td>
                            <td style="width: 20%;"><p>'.$Soma1.'</p></td>
                            <td style="width: 30%;"><p></p></td>
                            <td style="width: 20%;"><p>'.$Soma3.'</p></td>
                          </tr>
                        </table>    
                      </tr>
                    </table>
                  </div>
                  <div style="margin-top: 1rem;">
                    <a href="">
                      <img class="logo" src="/imgs/pdf.png" style="width: 2rem; height: 1.8rem; padding-right: 0.5rem;">Clique aqui para imprimir este relatório em PDF</br>
                    </a>
                    <a href="">
                      <img class="logo" src="/imgs/pdf.png" style="width: 2rem; height: 1.8rem; padding-right: 0.5rem; padding-top: 0.5rem;">Clique aqui para imprimir todos os relatórios em PDF
                    </a>
                  </div>
                </div>
              ';
              ?>

              <?php
                include("func_produtos.php");
                echo '
                <div id="tab5" class="tab">
                  <div align=center>
                    <h3>Produtos</h3>
                    <table class="tabusuario">     
                      <tr>
                          <th><p></p></th>
                          <th><p>Preço</p></th>
                          <th><p>Quantidade</p></th>
                          <th><p>Marketing</p></th>
                          <th><p>Qualidade</p></th>
                          <th><p>Publicidade</p></th>
                          <th><p>P&D</p></th>
                      </tr>
                      <tr> 
                        <td><p>Produto 1</p></td>
                        <td><p>'.$preco1.'</p></td>
                        <td><p>'.$quantidade1.'</p></td>
                        <td><p>'.$marketing1.'</p></td>
                        <td><p>'.$qualidade1.'</p></td>
                        <td><p>'.$publicidade1.'</p></td>
                        <td><p>'.$ped1.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>Produto 2</p></td>
                        <td><p>'.$preco2.'</p></td>
                        <td><p>'.$quantidade2.'</p></td>
                        <td><p>'.$marketing2.'</p></td>
                        <td><p>'.$qualidade2.'</p></td>
                        <td><p>'.$publicidade2.'</p></td>
                        <td><p>'.$ped2.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>Produto 3</p></td>
                        <td><p>'.$preco3.'</p></td>
                        <td><p>'.$quantidade3.'</p></td>
                        <td><p>'.$marketing3.'</p></td>
                        <td><p>'.$qualidade3.'</p></td>
                        <td><p>'.$publicidade3.'</p></td>
                        <td><p>'.$ped3.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>Produto 4</p></td>
                        <td><p>'.$preco4.'</p></td>
                        <td><p>'.$quantidade4.'</p></td>
                        <td><p>'.$marketing4.'</p></td>
                        <td><p>'.$qualidade4.'</p></td>
                        <td><p>'.$publicidade4.'</p></td>
                        <td><p>'.$ped4.'</p></td>
                      </tr>
                    </table>
                    <h3>Funcionário</h3>
                    <table class="tabusuario">     
                      <tr>
                          <th><p></p></th>
                          <th><p>Número</p></th>
                          <th><p>Salário (R$)</p></th>
                          <th><p>Salário Total (R$)</p></th>
                      </tr>
                      <tr> 
                        <td><p>Operários na montagem</p></td>
                        <td><p>'.$operariosmont.'</p></td>
                        <td><p>'.$operarios2.'</p></td>
                        <td><p>'.$operarios3.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>Operários de máquina</p></td>
                        <td><p>'.$montagem1.'</p></td>
                        <td><p>'.$montagem2.'</p></td>
                        <td><p>'.$montagem3.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>Demais funcionários</p></td>
                        <td><p>'.$demaisfunc1.'</p></td>
                        <td><p>'.$demaisfunc2.'</p></td>
                        <td><p>'.$demaisfunc3.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>Administrativos</p></td>
                        <td><p>'.$administrativo1.'</p></td>
                        <td><p>'.$administrativo2.'</p></td>
                        <td><p>'.$administrativo3.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>Totais</p></td>
                        <td><p>'.$total1.'</p></td>
                        <td><p></p></td>
                        <td><p>'.$total2.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>Salário Médio</p></td>
                        <td><p></p></td>
                        <td><p>'.$salmedio.'</p></td>
                        <td><p></p></td>
                      </tr>
                    </table>
                    <h3>Máquinas</h3>
                    <table class="tabusuario">     
                      <tr>
                          <th><p>Nº Máquina</p></th>
                          <th><p>Quantidade</p></th>
                      </tr>
                      <tr> 
                        <td><p>Máquina 1</p></td>
                        <td><p>'.$maquina1.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>Máquina 2</p></td>
                        <td><p>'.$maquina2.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>Máquina 3</p></td>
                        <td><p>'.$maquina3.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>Máquina 4</p></td>
                        <td><p>'.$maquina4.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>Máquina 5</p></td>
                        <td><p>'.$maquina5.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>Máquina 6</p></td>
                        <td><p>'.$maquina6.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>Máquina 7</p></td>
                        <td><p>'.$maquina7.'</p></td>
                      </tr>
                    </table>
                    <h3>Outras informações</h3>
                    <table class="tabusuario">     
                      <tr> 
                        <td><p>Empréstimo (R$)</p></td>
                        <td><p>'.$emprestimo.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>Amortização de Empréstimo (R$)</p></td>
                        <td><p>'.$amorempr.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>Aplicação</p></td>
                        <td><p>'.$aplicacao.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>Parcela de compra</p></td>
                        <td><p>'.$numParcelaCompra.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>Parcela de Venda</p></td>
                        <td><p>'.$numParcelaVenda.'</p></td>
                      </tr>
                      <tr> 
                        <td><p>Porcentagem de venda</p></td>
                        <td><p>'.$porcentagemVendaPrazo.'</p></td>
                      </tr>
                    </table>
                  </div>
                  <div style="margin-top: 1rem;">
                    <a href="">
                      <img class="logo" src="/imgs/pdf.png" style="width: 2rem; height: 1.8rem; padding-right: 0.5rem;">Clique aqui para imprimir este relatório em PDF</br>
                    </a>
                    <a href="">
                      <img class="logo" src="/imgs/pdf.png" style="width: 2rem; height: 1.8rem; padding-right: 0.5rem; padding-top: 0.5rem;">Clique aqui para imprimir todos os relatórios em PDF
                    </a>
                  </div>
                </div>
              ';
              ?>


                <div id="tab6" class="tab">
                  <div align=center>
                    <h3>Ranking Geral</h3>
                    <table class="tabusuario">     
                      <tr>
                        <th>Coloca&ccedil;&atilde;o</th>
                        <th>Nome da equipe</th>
                        <th>Pontuação</th>
                      </tr>
             
                      <?php
                        // SERÃO ELENCADOS, NO SELECT E OPTION, OS JOGOS QUE O JOGADOR ESTÁ CADASTRADO      
                        $select="SELECT ranking.Equipe, ranking.Geral, equipe.NomeEquipe from ranking, equipe WHERE equipe.CodJogo= ".$codjogo." AND equipe.CodEquipe=ranking.Equipe AND Jogada = ".$jogada." order by Geral DESC";

                        $resultado=mysqli_query($con, $select);
                        // SELECT DE TODOS O JOGOS QUE O JOGADOR ESTÁ CADASTRADO
                        $rows=mysqli_num_rows($resultado);
              
                        for($cont=1; $cont<=$rows; $cont++)
                        {
                          $campo = mysqli_fetch_object($resultado);
                          echo '<tr>
                          <td><p>'.$cont.'</p></td>
                          <td><p>'.$campo->NomeEquipe.'</p></td>
                          <td><p>'.$campo->Geral.'</p></td>
                              </tr>';
                        }
                      ?>
                    </table>
                  </div>
                  <div style="margin-top: 1rem;">
                    <a href="">
                      <img class="logo" src="/imgs/pdf.png" style="width: 2rem; height: 1.8rem; padding-right: 0.5rem;">Clique aqui para imprimir este relatório em PDF</br>
                    </a>
                    <a href="">
                      <img class="logo" src="/imgs/pdf.png" style="width: 2rem; height: 1.8rem; padding-right: 0.5rem; padding-top: 0.5rem;">Clique aqui para imprimir todos os relatórios em PDF
                    </a>
                  </div>
                </div>




              <?php

                include("func_indices.php");
                echo '
                <div id="tab7" class="tab">
                  <div align=center>
                    <h3>Índices</h3>
                    <h3>Investimentos da equipe:</h3>
                    <table class="tabusuario">     
                      <tr>
                        <th>Item</th>
                        <th><p>Produto 1</p></th>
                        <th><p>Produto 2</p></th>
                        <th><p>Produto 3</p></th>
                        <th><p>Produto 4</p></th>
                      </tr>
                      <tr> 
                        <td><p>Qualidade</p></td>
                        <td><p>'.number_format($P[0]->Qualidade,2,',','.').'</p></td>
                        <td><p>'.number_format($P[1]->Qualidade,2,',','.').'</p></td>
                        <td><p>'.number_format($P[2]->Qualidade,2,',','.').'</p></td>
                        <td><p>'.number_format($P[3]->Qualidade,2,',','.').'</p></td>
                      </tr>
                      <tr>
                        <td><p>Publicidade</p></td>
                        <td><p>'.number_format($P[0]->Publicidade,2,',','.').'</p></td>
                        <td><p>'.number_format($P[1]->Publicidade,2,',','.').'</p></td>
                        <td><p>'.number_format($P[2]->Publicidade,2,',','.').'</p></td>
                        <td><p>'.number_format($P[3]->Publicidade,2,',','.').'</p></td>
                      </tr>
                      <tr>
                        <td><p>Marketing</p></td>
                        <td><p>'.number_format($P[0]->Marketing,2,',','.').'</p></td>
                        <td><p>'.number_format($P[1]->Marketing,2,',','.').'</p></td>
                        <td><p>'.number_format($P[2]->Marketing,2,',','.').'</p></td>
                        <td><p>'.number_format($P[3]->Marketing,2,',','.').'</p></td>
                      </tr>
                      <tr>
                        <td><p>PeD</p></td>
                        <td><p>'.number_format($P[0]->PeD,2,',','.').'</p></td>
                        <td><p>'.number_format($P[1]->PeD,2,',','.').'</p></td>
                        <td><p>'.number_format($P[2]->PeD,2,',','.').'</p></td>
                        <td><p>'.number_format($P[3]->PeD,2,',','.').'</p></td>
                      </tr>
                    </table>
                    <h3>Máximos e mínimos</h3>
                    <table class="tabusuario">     
                      <tr>
                        <th><p>Item</p></th>
                        <th><p>Produto 1</p></th>
                        <th><p>Produto 2</p></th>
                        <th><p>Produto 3</p></th>
                        <th><p>Produto 4</p></th>
                      </tr>
                      <tr> 
                        <td><p>Qualidade (Máximo)</p></td>
                        <td><p>'.number_format($iQualidadeMA[0],2,',','.').'</p></td>
                        <td><p>'.number_format($iQualidadeMA[1],2,',','.').'</p></td>
                        <td><p>'.number_format($iQualidadeMA[2],2,',','.').'</p></td>
                        <td><p>'.number_format($iQualidadeMA[3],2,',','.').'</p></td>
                      </tr>
                      <tr> 
                        <td><p>Qualidade (Mínimo)</p></td>
                        <td><p>'.number_format($iQualidadeM[0],2,',','.').'</p></td>
                        <td><p>'.number_format($iQualidadeM[1],2,',','.').'</p></td>
                        <td><p>'.number_format($iQualidadeM[2],2,',','.').'</p></td>
                        <td><p>'.number_format($iQualidadeM[3],2,',','.').'</p></td>
                      </tr>
                      <tr>
                        <td><p>Publicidade (Máximo)</p></td>
                        <td><p>'.number_format($iPublicidadeMA[0],2,',','.').'</p></td>
                        <td><p>'.number_format($iPublicidadeMA[1],2,',','.').'</p></td>
                        <td><p>'.number_format($iPublicidadeMA[2],2,',','.').'</p></td>
                        <td><p>'.number_format($iPublicidadeMA[3],2,',','.').'</p></td>
                      </tr>
                      <tr>
                        <td><p>Publicidade (Mínimo)</p></td>
                        <td><p>'.number_format($iPublicidadeM[0],2,',','.').'</p></td>
                        <td><p>'.number_format($iPublicidadeM[1],2,',','.').'</p></td>
                        <td><p>'.number_format($iPublicidadeM[2],2,',','.').'</p></td>
                        <td><p>'.number_format($iPublicidadeM[3],2,',','.').'</p></td>
                      </tr>
                      <tr>
                        <td><p>Marketing (Máximo)</p></td>
                        <td><p>'.number_format($iMarketingMA[0],2,',','.').'</p></td>
                        <td><p>'.number_format($iMarketingMA[1],2,',','.').'</p></td>
                        <td><p>'.number_format($iMarketingMA[2],2,',','.').'</p></td>
                        <td><p>'.number_format($iMarketingMA[3],2,',','.').'</p></td>
                      </tr>
                      <tr>
                        <td><p>Marketing (Mínimo)</p></td>
                        <td><p>'.number_format($iMarketingM[0],2,',','.').'</p></td>
                        <td><p>'.number_format($iMarketingM[1],2,',','.').'</p></td>
                        <td><p>'.number_format($iMarketingM[2],2,',','.').'</p></td>
                        <td><p>'.number_format($iMarketingM[3],2,',','.').'</p></td>
                      </tr>
                      <tr>
                        <td><p>PeD (Máximo)</p></td>
                        <td><p>'.number_format($iPeDMA[0],2,',','.').'</p></td>
                        <td><p>'.number_format($iPeDMA[1],2,',','.').'</p></td>
                        <td><p>'.number_format($iPeDMA[2],2,',','.').'</p></td>
                        <td><p>'.number_format($iPeDMA[3],2,',','.').'</p></td>
                      </tr>
                      <tr>
                        <td><p>PeD (Mínimo)</p></td>
                        <td><p>'.number_format($iPeDM[0],2,',','.').'</p></td>
                        <td><p>'.number_format($iPeDM[1],2,',','.').'</p></td>
                        <td><p>'.number_format($iPeDM[2],2,',','.').'</p></td>
                        <td><p>'.number_format($iPeDM[3],2,',','.').'</p></td>
                      </tr>
                    </table>
                    <h3>Market Share</h3>
                    <table class="tabusuario">     
                      <tr>
                          <th><p></p></th>
                          <th><p>Receita</p></th>
                          <th><p>Quantidade</p></th>
                          <th><p>Endividamento</p></th>
                          <th><p>Nome da equipe</p></th>
                      </tr>
                      <tr> 
                        <td><p>Equipe</p></td>
                        <td><p>'.number_format($equipe_receita,6,',','.').'</p></td>
                        <td><p>'.number_format($equipe_quantidade,6,',','.').'</p></td>
                        <td><p>'.number_format($equipe_endividamento,6,',','.').'</p></td>
                        <td><p>'.number_format($equipe_lucratividade,6,',','.').'</p></td>
                      </tr>
                      <tr> 
                        <td><p>Melhor Indicador</p></td>
                        <td><p>'.number_format($m_receita,6,',','.').'<br />'.$m_receita_equipe.'</p></td>
                        <td><p>'.number_format($m_quantidade,6,',','.').'<br />'.$m_quantidade_equipe.'</br></p></td>
                        <td><p>'.number_format($m_endividamento,6,',','.').'<br />'.$m_endividamento_equipe.'</br></p></td>
                        <td><p>'.number_format($m_lucratividade,6,',','.').'<br />'.$m_lucratividade_equipe.'</br></p></td>
                      </tr>
                    </table>
                    <h3>Dados do Mercado</h3>
                    <table class="tabusuario">     
                      <tr>
                          <th><p>Item</p></th>
                          <th><p>Produto 1</p></th>
                          <th><p>Produto 2</p></th>
                          <th><p>Produto 3</p></th>
                          <th><p>Produto 4</p></th>
                      </tr>
                      <tr> 
                        <td><p>Mercado Tt</p></td>
                        <td><p>'.number_format($tamercado1,0,',','.').'</p></td>
                        <td><p>'.number_format($tamercado2,0,',','.').'</p></td>
                        <td><p>'.number_format($tamercado3,0,',','.').'</p></td>
                        <td><p>'.number_format($tamercado4,0,',','.').'</p></td>
                      </tr>
                      <tr> 
                        <td><p>Vendas Máx</p></td>
                        <td><p>'.number_format($iVendasMA[0],0,',','.').'</p></td>
                        <td><p>'.number_format($iVendasMA[1],0,',','.').'</p></td>
                        <td><p>'.number_format($iVendasMA[2],0,',','.').'</p></td>
                        <td><p>'.number_format($iVendasMA[3],0,',','.').'</p></td>
                      </tr>
                      <tr> 
                        <td><p>Perdas Máx</p></td>
                        <td><p>'.number_format($iPerdasMA[0],0,',','.').'</p></td>
                        <td><p>'.number_format($iPerdasMA[1],0,',','.').'</p></td>
                        <td><p>'.number_format($iPerdasMA[2],0,',','.').'</p></td>
                        <td><p>'.number_format($iPerdasMA[3],0,',','.').'</p></td>
                      </tr>
                      <tr> 
                        <td><p>Preço Máx</p></td>
                        <td><p>'.number_format($maior1,2,',','.').'</p></td>
                        <td><p>'.number_format($maior2,2,',','.').'</p></td>
                        <td><p>'.number_format($maior3,2,',','.').'</p></td>
                        <td><p>'.number_format($maior4,2,',','.').'</p></td>
                      </tr>
                      <tr> 
                        <td><p>Preço Mín</p></td>
                        <td><p>'.number_format($menor1,2,',','.').'</p></td>
                        <td><p>'.number_format($menor2,2,',','.').'</p></td>
                        <td><p>'.number_format($menor3,2,',','.').'</p></td>
                        <td><p>'.number_format($menor4,2,',','.').'</p></td>
                      </tr>
                      <tr> 
                        <td><p>Estoque Tt</p></td>
                        <td><p>'.number_format($somaestoque1,0,',','.').'</p></td>
                        <td><p>'.number_format($somaestoque2,0,',','.').'</p></td>
                        <td><p>'.number_format($somaestoque3,0,',','.').'</p></td>
                        <td><p>'.number_format($somaestoque4,0,',','.').'</p></td>
                      </tr>
                    </table>
                  </div>
                ';
                ?>

                <div style="margin-top: 1rem;">
        <a href="">
        <img class="logo" src="/imgs/pdf.png" style="width: 2rem; height: 1.8rem; padding-right: 0.5rem;">Clique aqui para imprimir este relatório em PDF</br>
                    </a>
                    <a href="">
                      <img class="logo" src="/imgs/pdf.png" style="width: 2rem; height: 1.8rem; padding-right: 0.5rem; padding-top: 0.5rem;">Clique aqui para imprimir todos os relatórios em PDF
                    </a>
                  </div>
                </div>           
            </div>
          </div>
        </br>
        <!-- SELECT QUE MOSTRA AS JOGADAS -->