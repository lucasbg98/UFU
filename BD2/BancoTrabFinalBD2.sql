PGDMP     ;                    y            TrabFinalBD2    13.2    13.2 *    �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    24840    TrabFinalBD2    DATABASE     n   CREATE DATABASE "TrabFinalBD2" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'Portuguese_Brazil.1252';
    DROP DATABASE "TrabFinalBD2";
                postgres    false            �            1255    25143 8   atualiza_reserva_equipamento(integer, character varying)    FUNCTION       CREATE FUNCTION public.atualiza_reserva_equipamento(npatri integer, cod character varying) RETURNS void
    LANGUAGE plpgsql
    AS $$
begin
update usa_equip set fk_usuaro_cod = cod and fk_equipamentos_npatrimonio = npatri and data_emprestimo = current_date;
end;
$$;
 Z   DROP FUNCTION public.atualiza_reserva_equipamento(npatri integer, cod character varying);
       public          postgres    false            �            1255    25144 8   atualiza_reserva_laboratorio(character varying, integer)    FUNCTION        CREATE FUNCTION public.atualiza_reserva_laboratorio(ucod character varying, lcod integer) RETURNS void
    LANGUAGE plpgsql
    AS $$
begin
 update Reserva set fk_usuaro_cod = UCod and fk_Laboratorio_Cod = LCod and data_emprestimo =
current_date;
end;
$$;
 Y   DROP FUNCTION public.atualiza_reserva_laboratorio(ucod character varying, lcod integer);
       public          postgres    false            �            1255    25134    equipamento_atrasado()    FUNCTION     "  CREATE FUNCTION public.equipamento_atrasado() RETURNS SETOF record
    LANGUAGE plpgsql
    AS $$
BEGIN
 RETURN query select usuario.nome, cod, npatrimonio,equipamentos.nome, data_recebimento
 FROM usuario, equipamentos, usa_equip
 WHERE current_date >= data_recebimento;
 RETURN;
END;
$$;
 -   DROP FUNCTION public.equipamento_atrasado();
       public          postgres    false            �            1259    24846    equipamentos    TABLE     �  CREATE TABLE public.equipamentos (
    item integer,
    npatrimonio integer NOT NULL,
    nome character varying(30),
    descricao character varying(30),
    processo character varying(30),
    empenho character varying(30),
    empenho_siafi character varying(30),
    local character varying(30),
    observacao character varying(40),
    reservado character varying DEFAULT 0
);
     DROP TABLE public.equipamentos;
       public         heap    postgres    false            �           0    0    TABLE equipamentos    ACL     J   GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE public.equipamentos TO alunos;
          public          postgres    false    201            �            1259    24861    laboratorio    TABLE     i   CREATE TABLE public.laboratorio (
    cod integer NOT NULL,
    reservado character varying DEFAULT 0
);
    DROP TABLE public.laboratorio;
       public         heap    postgres    false            �           0    0    TABLE laboratorio    ACL     N   GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE public.laboratorio TO professores;
          public          postgres    false    204            �            1259    24851    material    TABLE     �  CREATE TABLE public.material (
    item integer,
    cod integer NOT NULL,
    nome character varying(30),
    descricao character varying(30),
    quant_recebida integer,
    unidade character varying(30),
    danificado_descartado integer,
    total integer,
    local character varying(30),
    tipo character varying(30),
    empenho character varying(30),
    empenho_siafi character varying(30),
    observacao character varying(40),
    reservado character varying(30)
);
    DROP TABLE public.material;
       public         heap    postgres    false            �           0    0    TABLE material    ACL     F   GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE public.material TO alunos;
          public          postgres    false    202            �            1259    24841 	   reagentes    TABLE     ;  CREATE TABLE public.reagentes (
    cod integer NOT NULL,
    nome character varying(30),
    grupo character varying(30),
    quant_estoque integer,
    quant_recipiente integer,
    quant_usada integer,
    total integer,
    unidade character(1),
    tipo character varying(30),
    obs character varying(40)
);
    DROP TABLE public.reagentes;
       public         heap    postgres    false            �           0    0    TABLE reagentes    ACL     G   GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE public.reagentes TO alunos;
          public          postgres    false    200            �            1259    25164    reserva    TABLE     �   CREATE TABLE public.reserva (
    fk_usuario_cod integer,
    fk_laboratorio_cod integer,
    data_emprestimo character varying(30),
    data_recebimento character varying(30)
);
    DROP TABLE public.reserva;
       public         heap    postgres    false            �            1259    25161 	   usa_equip    TABLE     �   CREATE TABLE public.usa_equip (
    fk_usuario_cod integer,
    fk_equipamentos_npatrimonio integer,
    data_emprestimo character varying(30),
    data_recebimento character varying(30)
);
    DROP TABLE public.usa_equip;
       public         heap    postgres    false            �            1259    25167    usa_mat    TABLE     �   CREATE TABLE public.usa_mat (
    fk_material_cod integer,
    fk_usuario_cod integer,
    data_emprestimo character varying(30),
    data_recebimento character varying(30)
);
    DROP TABLE public.usa_mat;
       public         heap    postgres    false            �            1259    25158    usa_reag    TABLE     �   CREATE TABLE public.usa_reag (
    fk_usuario_cod integer,
    fk_reagentes_cod integer,
    data_emprestimo character varying(30),
    data_recebimento character varying(30)
);
    DROP TABLE public.usa_reag;
       public         heap    postgres    false            �            1259    24856    usuario    TABLE     �   CREATE TABLE public.usuario (
    nome character varying(30),
    tipo_usuario character varying(30),
    email character varying(30),
    cod integer NOT NULL,
    senha character varying(30)
);
    DROP TABLE public.usuario;
       public         heap    postgres    false            �          0    24846    equipamentos 
   TABLE DATA           �   COPY public.equipamentos (item, npatrimonio, nome, descricao, processo, empenho, empenho_siafi, local, observacao, reservado) FROM stdin;
    public          postgres    false    201   �6       �          0    24861    laboratorio 
   TABLE DATA           5   COPY public.laboratorio (cod, reservado) FROM stdin;
    public          postgres    false    204   �7       �          0    24851    material 
   TABLE DATA           �   COPY public.material (item, cod, nome, descricao, quant_recebida, unidade, danificado_descartado, total, local, tipo, empenho, empenho_siafi, observacao, reservado) FROM stdin;
    public          postgres    false    202   �7       �          0    24841 	   reagentes 
   TABLE DATA           ~   COPY public.reagentes (cod, nome, grupo, quant_estoque, quant_recipiente, quant_usada, total, unidade, tipo, obs) FROM stdin;
    public          postgres    false    200   �8       �          0    25164    reserva 
   TABLE DATA           h   COPY public.reserva (fk_usuario_cod, fk_laboratorio_cod, data_emprestimo, data_recebimento) FROM stdin;
    public          postgres    false    207   �9       �          0    25161 	   usa_equip 
   TABLE DATA           s   COPY public.usa_equip (fk_usuario_cod, fk_equipamentos_npatrimonio, data_emprestimo, data_recebimento) FROM stdin;
    public          postgres    false    206   �9       �          0    25167    usa_mat 
   TABLE DATA           e   COPY public.usa_mat (fk_material_cod, fk_usuario_cod, data_emprestimo, data_recebimento) FROM stdin;
    public          postgres    false    208   �9       �          0    25158    usa_reag 
   TABLE DATA           g   COPY public.usa_reag (fk_usuario_cod, fk_reagentes_cod, data_emprestimo, data_recebimento) FROM stdin;
    public          postgres    false    205   :       �          0    24856    usuario 
   TABLE DATA           H   COPY public.usuario (nome, tipo_usuario, email, cod, senha) FROM stdin;
    public          postgres    false    203   !:       J           2606    24850    equipamentos equipamentos_pkey 
   CONSTRAINT     e   ALTER TABLE ONLY public.equipamentos
    ADD CONSTRAINT equipamentos_pkey PRIMARY KEY (npatrimonio);
 H   ALTER TABLE ONLY public.equipamentos DROP CONSTRAINT equipamentos_pkey;
       public            postgres    false    201            P           2606    24865    laboratorio laboratorio_pkey 
   CONSTRAINT     [   ALTER TABLE ONLY public.laboratorio
    ADD CONSTRAINT laboratorio_pkey PRIMARY KEY (cod);
 F   ALTER TABLE ONLY public.laboratorio DROP CONSTRAINT laboratorio_pkey;
       public            postgres    false    204            L           2606    24855    material material_pkey 
   CONSTRAINT     U   ALTER TABLE ONLY public.material
    ADD CONSTRAINT material_pkey PRIMARY KEY (cod);
 @   ALTER TABLE ONLY public.material DROP CONSTRAINT material_pkey;
       public            postgres    false    202            H           2606    24845    reagentes reagentes_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY public.reagentes
    ADD CONSTRAINT reagentes_pkey PRIMARY KEY (cod);
 B   ALTER TABLE ONLY public.reagentes DROP CONSTRAINT reagentes_pkey;
       public            postgres    false    200            N           2606    25148    usuario usuario_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (cod);
 >   ALTER TABLE ONLY public.usuario DROP CONSTRAINT usuario_pkey;
       public            postgres    false    203            U           2606    25190    reserva fk_reserva_1    FK CONSTRAINT     �   ALTER TABLE ONLY public.reserva
    ADD CONSTRAINT fk_reserva_1 FOREIGN KEY (fk_usuario_cod) REFERENCES public.usuario(cod) ON UPDATE CASCADE ON DELETE SET NULL;
 >   ALTER TABLE ONLY public.reserva DROP CONSTRAINT fk_reserva_1;
       public          postgres    false    2894    207    203            V           2606    25195    reserva fk_reserva_2    FK CONSTRAINT     �   ALTER TABLE ONLY public.reserva
    ADD CONSTRAINT fk_reserva_2 FOREIGN KEY (fk_laboratorio_cod) REFERENCES public.laboratorio(cod) ON UPDATE CASCADE ON DELETE SET NULL;
 >   ALTER TABLE ONLY public.reserva DROP CONSTRAINT fk_reserva_2;
       public          postgres    false    2896    207    204            S           2606    25180    usa_equip fk_usa_equip_1    FK CONSTRAINT     �   ALTER TABLE ONLY public.usa_equip
    ADD CONSTRAINT fk_usa_equip_1 FOREIGN KEY (fk_usuario_cod) REFERENCES public.usuario(cod) ON UPDATE CASCADE ON DELETE SET NULL;
 B   ALTER TABLE ONLY public.usa_equip DROP CONSTRAINT fk_usa_equip_1;
       public          postgres    false    206    2894    203            T           2606    25185    usa_equip fk_usa_equip_2    FK CONSTRAINT     �   ALTER TABLE ONLY public.usa_equip
    ADD CONSTRAINT fk_usa_equip_2 FOREIGN KEY (fk_equipamentos_npatrimonio) REFERENCES public.equipamentos(npatrimonio) ON UPDATE CASCADE ON DELETE SET NULL;
 B   ALTER TABLE ONLY public.usa_equip DROP CONSTRAINT fk_usa_equip_2;
       public          postgres    false    2890    201    206            W           2606    25200    usa_mat fk_usa_mat_1    FK CONSTRAINT     �   ALTER TABLE ONLY public.usa_mat
    ADD CONSTRAINT fk_usa_mat_1 FOREIGN KEY (fk_material_cod) REFERENCES public.material(cod) ON UPDATE CASCADE ON DELETE SET NULL;
 >   ALTER TABLE ONLY public.usa_mat DROP CONSTRAINT fk_usa_mat_1;
       public          postgres    false    208    2892    202            X           2606    25205    usa_mat fk_usa_mat_2    FK CONSTRAINT     �   ALTER TABLE ONLY public.usa_mat
    ADD CONSTRAINT fk_usa_mat_2 FOREIGN KEY (fk_usuario_cod) REFERENCES public.usuario(cod) ON UPDATE CASCADE ON DELETE SET NULL;
 >   ALTER TABLE ONLY public.usa_mat DROP CONSTRAINT fk_usa_mat_2;
       public          postgres    false    2894    203    208            Q           2606    25170    usa_reag fk_usa_reag_1    FK CONSTRAINT     �   ALTER TABLE ONLY public.usa_reag
    ADD CONSTRAINT fk_usa_reag_1 FOREIGN KEY (fk_usuario_cod) REFERENCES public.usuario(cod) ON UPDATE CASCADE ON DELETE SET NULL;
 @   ALTER TABLE ONLY public.usa_reag DROP CONSTRAINT fk_usa_reag_1;
       public          postgres    false    2894    205    203            R           2606    25175    usa_reag fk_usa_reag_2    FK CONSTRAINT     �   ALTER TABLE ONLY public.usa_reag
    ADD CONSTRAINT fk_usa_reag_2 FOREIGN KEY (fk_reagentes_cod) REFERENCES public.reagentes(cod) ON UPDATE CASCADE ON DELETE SET NULL;
 @   ALTER TABLE ONLY public.usa_reag DROP CONSTRAINT fk_usa_reag_2;
       public          postgres    false    2888    200    205            �     x���;N�0�zr��@����2�di�^��.M��V@�r���� ��r1H�-�f�|?�dI�A?8����V�P���J���0F7QA�P�"�Ɋ+�Â�o9�� 1�\	NҤ�A͟��<���';M�' AZx�<��	�S�JjU�.�kэ���h�D��B�r_i�4�w��ke������ֺ�<��]y�y��?y1ݹ�/�!n�k�.x�&�H��ٮ�=�o�0��nlm� �k-/�(�oop�      �      x�3�4�2b 6��2QFf@2F��� 8b�      �   �   x���A�0E��Sx��R�Rԥ�ܱ)�Ѫ��b�u<�G�bR�	&�\��d�^�p�(����b�'�$�ppV+m �1M������d�J+@�L,�Y<���V"�B��h)�F�<R��(f9��isVߜ��}h�L��]U�j�W�cS*(�&M2�8�|�,�
K�v�
���i�x|c�B�={~�L]�[�'���)LEByb�k�      �   �   x�mϱ
�0���u)I��b�H4�S��Q�������G�i*bA�����Q��W!��M{)4p���4C��|We�:7(!F���R�8���Y`X���5�h�A �W�$_�T��0�Y�.y��.(�0\���SŅ��נ��ڇJ4^�eb^���*\�;ۓ?(t'uA�˱��и�5�]i�����>����3]�      �      x������ � �      �      x������ � �      �      x������ � �      �      x������ � �      �   o   x�U��
�0������Y����
+bV���$)�m�yLPV���b��V''"o���|��yzC���&?&���pb�KR��֩���-��O_�^ܖ1���ގ�>��8�     